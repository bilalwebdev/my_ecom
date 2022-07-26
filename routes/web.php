<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\TaxController;
use App\Http\Controllers\Front\FrontController;
use App\Http\Controllers\Admin\HomeBannerController;
use App\Models\Admin;
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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('admin', [AdminController::class, 'index']);
Route::post('/admin/auth', [AdminController::class, 'auth'])->name('admin.auth');
Route::group(['middleware' =>'admin_auth'], function()
{
// ----category-------
  Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);
  Route::get('/admin/category', [CategoryController::class, 'category']);
  Route::get('/admin/manage-category', [CategoryController::class, 'manage_category']);
  Route::post('/admin/manage-category-process', [CategoryController::class, 'manage_category_process'])->name('category.insert');
  Route::get('/admin/category/delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');
  Route::get('/admin/manage-category/edit/{id}', [CategoryController::class, 'edit']);
  Route::post('/admin/manage-category/update/{id}', [CategoryController::class, 'update']);
  Route::get('/admin/category/status/{status}/{id}', [CategoryController::class, 'status']);
// ----coupon--------
//Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);
  Route::get('/admin/coupon', [CouponController::class, 'coupon']);
  Route::get('/admin/manage-coupon', [CouponController::class, 'manage_coupon']);
  Route::post('/admin/manage-coupon-process', [CouponController::class, 'manage_coupon_process'])->name('coupon.insert');
  Route::get('/admin/coupon/delete/{id}', [CouponController::class, 'delete'])->name('coupon.delete');
  Route::get('/admin/manage-coupon/edit/{id}', [CouponController::class, 'edit']);
  Route::post('/admin/manage-coupon/update/{id}', [CouponController::class, 'update']);
  Route::get('/admin/coupon/status/{status}/{id}', [CouponController::class, 'status']);
// ----size--------
//Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);
Route::get('/admin/size', [SizeController::class, 'size']);
Route::get('/admin/manage-size', [SizeController::class, 'manage_size']);
Route::post('/admin/manage-size-process', [SizeController::class, 'manage_size_process'])->name('size.insert');
Route::get('/admin/size/delete/{id}', [SizeController::class, 'delete'])->name('size.delete');
Route::get('/admin/manage-size/edit/{id}', [SizeController::class, 'edit']);
Route::post('/admin/manage-size/update/{id}', [SizeController::class, 'update']);
Route::get('/admin/size/status/{status}/{id}', [SizeController::class, 'status']);
// ----color-----
//Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);
Route::get('/admin/color', [ColorController::class, 'color']);
Route::get('/admin/manage-color', [ColorController::class, 'manage_color']);
Route::post('/admin/manage-color-process', [ColorController::class, 'manage_color_process'])->name('color.insert');
Route::get('/admin/color/delete/{id}', [ColorController::class, 'delete'])->name('color.delete');
Route::get('/admin/manage-color/edit/{id}', [ColorController::class, 'edit']);
Route::post('/admin/manage-color/update/{id}', [ColorController::class, 'update']);
Route::get('/admin/color/status/{status}/{id}', [ColorController::class, 'status']);
// ----product-----
//Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);
Route::get('/admin/product', [ProductController::class, 'product']);
Route::get('/admin/manage-product', [ProductController::class, 'manage_product']);
Route::post('/admin/manage-product-process', [ProductController::class, 'manage_product_process'])->name('product.insert');
Route::get('/admin/product/delete/{id}', [ProductController::class, 'delete'])->name('product.delete');
Route::get('/admin/manage-product/edit/{id}', [ProductController::class, 'edit']);
Route::post('/admin/manage-product/update/{id}', [ProductController::class, 'update']);
Route::get('/admin/product/status/{status}/{id}', [ProductController::class, 'status']);
Route::get('admin/manage-product/edit/product_attr_delete/{pid}/{id}', [ProductController::class, 'deleteAttr']);
Route::get('admin/manage-product/edit/product_img_delete/{pid}/{id}', [ProductController::class, 'deleteImg']);
// ----brand-----
//Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);
Route::get('/admin/brand', [BrandController::class, 'brand']);
Route::get('/admin/manage-brand', [BrandController::class, 'manage_brand']);
Route::post('/admin/manage-brand-process', [BrandController::class, 'manage_brand_process'])->name('brand.insert');
Route::get('/admin/brand/delete/{id}', [BrandController::class, 'delete'])->name('brand.delete');
Route::get('/admin/manage-brand/edit/{id}', [BrandController::class, 'edit']);
Route::post('/admin/manage-brand/update/{id}', [BrandController::class, 'update']);
Route::get('/admin/brand/status/{status}/{id}', [BrandController::class, 'status']);

// ----tax-----
//Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);
Route::get('/admin/tax', [TaxController::class, 'tax']);
Route::get('/admin/manage-tax', [TaxController::class, 'manage_tax']);
Route::post('/admin/manage-tax-process', [TaxController::class, 'manage_tax_process'])->name('tax.insert');
Route::get('/admin/tax/delete/{id}', [TaxController::class, 'delete'])->name('tax.delete');
Route::get('/admin/manage-tax/edit/{id}', [TaxController::class, 'edit']);
Route::post('/admin/manage-tax/update/{id}', [TaxController::class, 'update']);
Route::get('/admin/tax/status/{status}/{id}', [TaxController::class, 'status']);

// ------Banner-------

Route::get('/admin/banner', [HomeBannerController::class, 'banner']);
Route::get('/admin/manage-banner', [HomeBannerController::class, 'manage_banner']);
Route::post('/admin/manage-banner-process', [HomeBannerController::class, 'manage_banner_process'])->name('banner.insert');
Route::get('/admin/banner/delete/{id}', [HomeBannerController::class, 'delete'])->name('banner.delete');
Route::get('/admin/manage-banner/edit/{id}', [HomeBannerController::class, 'edit']);
Route::post('/admin/manage-banner/update/{id}', [HomeBannerController::class, 'update']);
Route::get('/admin/banner/status/{status}/{id}', [HomeBannerController::class, 'status']);

// ----customer----

Route::get('/admin/customer', [CustomerController::class, 'customer']);
Route::get('/admin/customer/status/{status}/{id}', [CustomerController::class, 'status']);
Route::get('/admin/show-customer/show/{id}', [CustomerController::class, 'show']);

});
Route::get('/admin/logout', function () {
    session()->forget('ADMIN_LOGIN');
    session()->forget('ADMIN_ID');
    session()->flash('error', 'Logout Successfuly');
    return redirect('admin/');
    });

// -----------front routes---------
Route::get('/', [FrontController::class, 'index']);
Route::get('product/{slug}', [FrontController::class, 'product']);
     //add-to-cart
Route::post('add-to-cart', [FrontController::class, 'addToCart']);
Route::get('cart', [FrontController::class, 'showCart']);






