<?php

use App\Http\Controllers\OrganiserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductGalleryController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectGalleryController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::prefix("dashboard")
        ->name("d_partials.")
        ->group(function() {
            Route::get("orgs",[OrganiserController::class,"dashboardLoader"])->name("dash_org_load");
            Route::get("projects",[ProjectController::class,"dashboardLoader"])->name("dash_project_load");
            Route::get("products",[ProductController::class,"dashboardLoader"])->name("dash_product_load");

    });

Route::name("static.")
        ->group(function() {
            Route::get("why-kindbox",function (){
                return view('pages.about.why');
            })->name('why_kindbox');
            Route::get("giving-back", function () {
                return view("pages.about.giving-back");
            })->name('giving_back');
            Route::get("team", function (){
                return view("pages.about.team");
            })->name('team');
    });


Route::prefix('shop')
        ->name('shop.')
        ->group( function() {
            Route::get("list",[ShopController::class,"index"])->name("shop_index");
            Route::get("/detail/{product}/{slug}",[ShopController::class,"product_detail"])->name("product_detail");
            Route::get("/cart",[ShopController::class,"cart"])->name('cart');
            Route::post('/add-to-cart/{product}',[ShopController::class,"add_to_cart"])->name('add_to_cart');
            Route::post('/checkout/',[ShopController::class,"checkout"])->name('checkout');
        });
Route::get('/search',[ShopController::class,"search_result"])->name('search');
Route::prefix('projects')
        ->name('projects.')
        ->group(function () {

            Route::get("list",[ProjectController::class,"list_project"])->name('public_project_list');
            Route::get('/{project}/{slug}',[ProjectController::class,"project_detail"])->name('public_project_detail');
    });
require __DIR__.'/auth.php';


Route::prefix("admin")
        ->name("organiser.")
        ->middleware(["auth"])
        ->group( function () {
            Route::resource("organiser",OrganiserController::class)->name("get","list");
            Route::post("/project/{project}/store",[ProjectGalleryController::class,"store"])->name('upload_project_gallery');
            Route::delete('/project/{project_gallery}/delete',[ProjectGalleryController::class,"destroy"])->name("delete_project_gallery");
            Route::get("/project/images/list/{project}",[ProjectController::class,"images"])->name("list_project_images");
            Route::get("/project/transaction/{project}",[ProjectController::class,"view_transaction"])->name('project_transaction');
            Route::resource("project",ProjectController::class)->name('get','list');
    });

ROute::prefix("admin")
        ->name("products.")
        ->middleware(["auth"])
        ->group( function () {
            Route::get("/product-verify",[ProductController::class,"product_code_verify"])->name('product_code_verification');
            Route::post('/gallery/{product}/store',[ProductGalleryController::class,"store"])->name("product_gallery_store");
            Route::delete('/gallery/{product}/delete',[ProductGalleryController::class,"destroy"])->name("product_gallery_delete");
            Route::get("/product/gallery/{product}/list",[ProductController::class,"product_gallery"])->name('product_gallery_view');
            Route::get("/product/orders",[ProductController::class,"orders"])->name('product_orders');
            Route::resource("product",ProductController::class)->name("get","product");
        });
