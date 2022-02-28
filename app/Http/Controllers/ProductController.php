<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductGallery;
use Illuminate\Http\Request;
use App\Http\Traits\Upload;
use App\Models\ProductTransaction;

class ProductController extends Controller
{   
    use Upload;
    //
    public function index() {
        $products = Product::get();
        return view('products.index',compact('products'));
    }

    public function create(){
        return view("products.create");
    }

    public function store(Request $request) {
        $request->validate([
            "product_name" => "required",
            "product_code" => "required|unique:products,product_code",
            "description" => "required",
            "item_price" => "required",
            "available_quantity" => "required",
            "featured_image" => "required"
        ]);

        $product = new Product;
        $product->product_name = $request->product_name;
        // check slug.
        $product_check = Product::where("slug",\Str::slug($request->product_name,"-"))->exists();
        if ($product_check) {
            return response([
                "success" => false,
                "message" => "Product with similar same already exists."
            ]);
        }

        if ($request->hasFile('featured_image') ) {
            $product->featured_image = $this->upload($request,"featured_image")->id;
        }
        $product->slug = \Str::slug($request->product_name,"-");
        $product->product_full_description = $request->description;
        $product->item_price = $request->item_price;
        $product->available_quantity = $request->available_quantity;
        $product->product_code = strtolower($request->product_code);

        $product->is_active = true;
        try {
            $product->save();
        } catch (\Throwable $th) {
            //throw $th;
            return response([
                "success" => false,
                "message" => "Unable to create new product",
                "error" => $th->getMessage()
            ]);
        }


        $request->session()->flash("success","Product Added. Please add images ");

        return response([
            "success" => true,
            "message" => "Please wait...redirecting you in few seconds.",
            'redirect' => route('products.product_gallery_view',$product->id)
        ]);
    }

    public function edit(Request $request, Product $product) {
        return view('products.edit',compact("product"));
    }

    public function update(Request $request, Product $product) {
        $request->validate([
            "product_name" => "required",
            "description" => "required",
            "item_price" => "required",
            "available_quantity" => "required"
        ]);

        $product->product_name = $request->product_name;
        // check slug.
        if ($product->isDirty("product_name") ) {
            $product_check = Product::where("slug",\Str::slug($request->product_name,"-"))->exists();
            if ($product_check) {
                return response([
                    "success" => false,
                    "message" => "Product with similar same already exists."
                ]);
            }
            $product->slug = \Str::slug($request->product_name,"-");

        }
        if ($request->hasFile('featured_image') ) {
            $product->featured_image = $this->upload($request,"featured_image")->id;
        }
        $product->product_full_description = $request->description;
        $product->item_price = $request->item_price;
        $product->available_quantity = $request->available_quantity;

        $product->is_active = true;
        try {
            $product->save();
        } catch (\Throwable $th) {
            //throw $th;
            return response([
                "success" => false,
                "message" => "Unable to update product information",
                "error" => $th->getMessage()
            ]);
        }


        $request->session()->flash("success","Product information updated. ");

        return response([
            "success" => true,
            "message" => "",
            'redirect' => route('products.product.edit',$product->id)
        ]);
    }

    public function destroy(Request $request, Product $product) {

        $product->delete();

        $request->session()->flash("success","Product Deleted !");
        return back();
    }

    public function product_gallery(Request $request, Product $product) {
        $products_image = ProductGallery::where('product_id',$product->id)->get();
        return view("products.images.index",compact("product","products_image"));
    }

    public function product_code_verify(Request $request ) {
        if (Product::where('product_code',$request->product_code)->exists() ) {
            return "<span class='text-danger'>Product Code Already in Use </span>";
        }
        return;
    }

    public function dashboardLoader(Request $request) {
        $products = Product::with(['featured'])->latest()->get();
        return view("welcome.partials.product",compact("products"));
    }

    public function orders() {
        $transactions = ProductTransaction::latest()->get();
        view('products.transaction',compact("transactions"));
    }
}
