<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductTransaction;
use App\Models\Project;
use App\Models\ProjectTransaction;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    //

    public function index() {
        $products = Product::with(['featured'])->latest()->paginate();
        return view('pages.shop.index',compact('products'));
    }

    public function product_detail(Product $product, $slug) {

        return view('pages.shop.detail',compact('product'));
    }

    public function add_to_cart(Request $request, Product $product) {


        if ($request->session()->has('cart') ) {
            $current_cart = session()->get('cart');
            $exists =   ( isset ($current_cart["pp_".$product->id])) ? true : false;
            if ( $exists ) {
                // update existing record
                $current_product  = $current_cart["pp_".$product->id];
                $current_qty = isset ( $current_product["qty"]) ? $current_product["qty"] : 1;
                $update_qty = $current_qty + 1;
                $update_price = $update_qty * $product->item_price;
                $current_product["qty"] = $update_qty;
                $current_product["price"] = $update_price;
                $current_product["name"] = $product->product_name;
                $current_product["u_price"] = $product->item_price;
                $current_product["thumb"] = asset($product->featured->path);

                $current_cart["pp_".$product->id] = $current_product;
                session(["cart" => $current_cart]);
            } else{
                $current_cart["pp_".$product->id] = [
                    "name"=>$product->product_name,
                    "qty" => 1,
                    "price" => $product->item_price,
                    "u_price" => $product->item_price,
                    "thumb" => asset($product->featured->path)

                ];
            }

            session()->forget("cart");
            session(["cart" => $current_cart]);

        } else {

            $request->session()->put("cart" , [
                "pp_".$product->id  => [
                    "name" => $product->product_name,
                    "qty" => 1,
                    "price" => $product->item_price * 1,
                    "thumb" => asset($product->featured->path),
                    "u_price" => $product->item_price
                ]
            ]);
    
        }
        return response([
            "success" => true,
            "title" => "Congratulation",
            "message" => "Your Product is now available on cart."
        ]);
    }

    public function cart()
    {

        $carts =  (session()->has('cart')) ?  session()->get("cart") : [];
        return view("cart.index",compact("carts"));
    }

    public function checkout(Request $request) {
        $request->validate([
            "project" => "required"
        ]);

        $product_transaction = new ProductTransaction;
        $project_transaction = new ProjectTransaction;
        $cart_value = session()->get('cart');
        $project = Project::find($request->project);
        foreach ($cart_value as $cart_key => $cart_data) {
            $explode_id = explode("_",$cart_key);

            $product_transaction->product_id = $explode_id[1];
            $product_transaction->product = json_encode($cart_data);
            $product_transaction->unit_price = $cart_data["u_price"];
            $product_transaction->qty = $cart_data["qty"];
            $product_transaction->debit = true;
            $product_transaction->total = $cart_data["price"];

            $product_transaction->save();

            // now let's transfer this amount to project.

            $project_amount = ($cart_data["price"] * 10) / 100;

            $project_transaction->project_id = $request->project;
            $project_transaction->product_id = $explode_id[1];
            $project_transaction->total_amount = $project_amount;
            $project_transaction->deduct_percentage = 10;
            $project_transaction->project_amount  = $cart_data["price"];
            $project_transaction->save();

            // also update total collected in project table.
            $project->total_collected = $project->total_collected + $project_amount;
            $project->save();

        }
        session()->forget('cart');
        return response([
            "success" => true,
            "title" => "Thank-You, For Your Effot",
            "message" => "We received your order. Your product is ready for shipping.",
            "redirect" => redirect()->to("/")
        ]);
    //    foreach (session())
        // session()->forget('cart');
    }

    public function search_result(Request $request) {
        // check in product
        $product_search = Product::where('product_name','like','%'.$request->term.'%')
                                ->get();
        // check in project

        $project_search = Project::where('project_title','like','%'.$request->term.'%')->get();

        return view('pages.search.index',compact('product_search','project_search'));

    }
}
