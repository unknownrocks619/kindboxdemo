<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Traits\Upload;
use App\Models\ProductGallery;

class ProductGalleryController extends Controller
{
    //
    use Upload;
    public function store(Request $request, Product $product) {
        
        $gallery = new ProductGallery;
        $gallery->product_id = $product->id;
        $gallery->file = $this->upload($request,"file");
        $gallery->save();

        return response([
            'success' => true,
            "message" => "Image uploaded",
            "image_data" => $gallery->id
        ]);

    }

    public function destroy(Request $request, productGallery $product_gallery) {

        $product_gallery->delete();

        $request->session()->flash("success","Image Deleted From Gallery.");
        return back();
    }
}
