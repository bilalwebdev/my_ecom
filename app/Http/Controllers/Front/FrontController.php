<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Front\Controller;
use App\Models\Admin\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class FrontController extends Controller
{
    public function index(Request $request)
    {

    $arr['home_categories'] = DB::table('categories')
    ->where(['status'=>1])
    ->where(['is_home'=>1])
    ->get();
 //   dd( $arr['home_categories']);
    foreach($arr['home_categories'] as $category)
    {
    $arr['home_categories_product'][$category->id] =DB::table('products')
    ->where(['status'=>1])
    ->where(['category_id'=>$category->id])
    ->get();
    foreach($arr['home_categories_product'][$category->id] as $product)
    {
    $arr['home_product_attr'][$product->id]  = DB::table('product_attr')
    ->leftjoin('sizes', 'sizes.id', '=' , 'product_attr.size_id')
    ->leftjoin('colors', 'colors.id', '=' , 'product_attr.color_id')
    ->where(['product_attr.products_id'=>$product->id])
    ->get();
    }
    }
    $arr['home_featured_product'][$category->id] = DB::table('products')
    ->where(['status'=>1])
    ->where(['is_featured'=>1])
    //->where(['category_id'=>$list->id])
    ->get();
    foreach($arr['home_featured_product'][$category->id] as $featured)
    {
    $arr['home_featured_product_attr'][$featured->id]  = DB::table('product_attr')
    ->leftjoin('sizes', 'sizes.id', '=' , 'product_attr.size_id')
    ->leftjoin('colors', 'colors.id', '=' , 'product_attr.color_id')
    ->where(['product_attr.products_id'=>$featured->id])
    ->get();
    }
    $arr['home_tranding_product'][$category->id] = DB::table('products')
    ->where(['status'=>1])
    ->where(['is_tranding'=>1])
    //->where(['category_id'=>$list->id])
    ->get();
    foreach($arr['home_tranding_product'][$category->id] as $trandng_product)
    {
    $arr['home_tranding_product_attr'][$trandng_product->id]  = DB::table('product_attr')
    ->leftjoin('sizes', 'sizes.id', '=' , 'product_attr.size_id')
    ->leftjoin('colors', 'colors.id', '=' , 'product_attr.color_id')
    ->where(['product_attr.products_id'=>$trandng_product->id])
    ->get();
    }
    $arr['home_discounted_product'][$category->id] = DB::table('products')
    ->where(['status'=>1])
    ->where(['is_discounted'=>1])
    //]->where(['category_id'=>$list->id])
    ->get();
    foreach($arr['home_discounted_product'][$category->id] as $discounted_product)
    {
    $arr['home_discounted_product_attr'][$discounted_product->id]  = DB::table('product_attr')
    ->leftjoin('sizes', 'sizes.id', '=' , 'product_attr.size_id')
    ->leftjoin('colors', 'colors.id', '=' , 'product_attr.color_id')
    ->where(['product_attr.products_id'=>$discounted_product->id])
    ->get();
    }
    $arr['home_brands'] = DB::table('brands')
    ->where(['status'=>1])
    ->where(['is_home'=>1])
    ->get();
    $arr['home_banners'] = DB::table('home_banners')
    ->where(['status'=>1])
    ->get();
   // dd($arr);
    return view('frontEnd.index',$arr);
    }
    public function product(Request $request, $slug)
    {
        $arr['product'] = DB::table('products')
        ->where(['status'=>1])
        ->where(['slug'=>$slug])
        ->get();
        foreach($arr['product'] as $product_detail)
        {
        $arr['product_attr'][$product_detail->id]  = DB::table('product_attr')
        ->leftjoin('sizes', 'sizes.id', '=' , 'product_attr.size_id')
        ->leftjoin('colors', 'colors.id', '=' , 'product_attr.color_id')
        ->where(['product_attr.products_id'=>$product_detail->id])
        ->get();
        $arr['product_images'][$product_detail->id]  = DB::table('product_images')
        ->where(['product_images.products_id'=>$product_detail->id])
        ->get();
        }
        $arr['related_product'] = DB::table('products')
        ->where(['status'=>1])
        ->where('slug', "!=", $slug)
        ->where(['category_id'=>$arr['product'][0]->category_id])
        ->get();
        foreach($arr['related_product'] as $related_product)
        {
        $arr['related_product_attr'][$related_product->id]  = DB::table('product_attr')
        ->leftjoin('sizes', 'sizes.id', '=' , 'product_attr.size_id')
        ->leftjoin('colors', 'colors.id', '=' , 'product_attr.color_id')
        ->where(['product_attr.products_id'=>$related_product->id])
        ->get();
        }

      //  dd($arr['product_images']);
       // dd($arr);
        // echo '<pre>';
        // print_r($arr['related_product']);
        // die();
        return view('frontEnd.product',$arr);
    }

    public function addToCart(Request $request)
    {
        if($request->session()->has('FRONT_USER_LOGIN'))
        {
            $user_id = $request->session()->get('FRONT_USER_LOGIN');
            $user_type = "Reg";
        }
        else{
            $user_id = getUserTempId();
            $user_type = "Non-Reg";
        }
        $size_id = $request['size'];
        $color_id = $request['color'];
        $pqty = $request['pqty'];
        $product_id = $request['product_id'];
        echo $size_id;
        echo $color_id;


        $result =  DB::table('product_attr')
        ->select('product_attr.id')
        ->leftjoin('sizes', 'sizes.id', '=' , 'product_attr.size_id')
        ->leftjoin('colors', 'colors.id', '=' , 'product_attr.color_id')
        ->where(['products_id'=> $product_id])
        ->where(['colors.color'=> $color_id])
        ->where(['sizes.size'=> $size_id])
        ->get();

         $product_attr_id = $result[0]->id;

         $check = DB::table('shopping_carts')
         ->where(['user_id' => $user_id])
         ->where(['user_type' => $user_type])
         ->where(['product_id' => $product_id])
         ->where(['product_attr_id' => $product_attr_id])
         ->get();
   //     dd($check);

         if(isset($check[0]))
         {
            $update_id = $check[0]->id;
             if($pqty == 0){
                DB::table('shopping_carts')
                ->where(['id' => $update_id])
                ->delete();
             }
             else{
                $update_id = $check[0]->id;
                DB::table('shopping_carts')
                ->where(['id' => $update_id])
                ->update(['qty' => $pqty]);
                $msg = "updated";
             }
         }
         else{
             $id =  DB::table('shopping_carts')
             ->insertGetId(
                [
                    'user_id' => $user_id,
                    'user_type' => $user_type,
                    'product_id' => $product_id,
                    'product_attr_id' => $product_attr_id,
                    'qty' => $pqty,
                    'added_on' => date('Y-m-d h:i:s')
                ]
                );
                $msg = "Added";
         }
         $cart_data = DB::table('shopping_carts')
         ->leftJoin('products', 'products.id', '=', 'shopping_carts.product_id')
         ->leftJoin('product_attr', 'product_attr.id', '=', 'shopping_carts.product_attr_id')
         ->leftjoin('sizes', 'sizes.id', '=' , 'product_attr.size_id')
         ->leftjoin('colors', 'colors.id', '=' , 'product_attr.color_id')
         ->where(['user_id' => $user_id])
         ->where(['user_type' => $user_type])
         ->select('shopping_carts.qty', 'products.name', 'products.image', 'products.slug',
          'sizes.size', 'colors.color', 'product_attr.price', 'products.id as pid', 'product_attr.id as attr_id')
         ->get();
         $total_items = count($cart_data);
         return response()->json(['msg' => $msg, 'data' => $cart_data,  't_items' => $total_items]);
    }


    public function showCart(Request $request)
    {
        if($request->session()->has('FRONT_USER_LOGIN'))
        {
           $user_id = $request->session()->get('FRONT_USER_LOGIN');
            $user_type = "Reg";
        }
        else{
            $user_id = getUserTempId();
            $user_type = "Non-Reg";
        }

         $cart_data = DB::table('shopping_carts')
         ->leftJoin('products', 'products.id', '=', 'shopping_carts.product_id')
         ->leftJoin('product_attr', 'product_attr.id', '=', 'shopping_carts.product_attr_id')
         ->leftjoin('sizes', 'sizes.id', '=' , 'product_attr.size_id')
         ->leftjoin('colors', 'colors.id', '=' , 'product_attr.color_id')
         ->where(['user_id' => $user_id])
         ->where(['user_type' => $user_type])
         ->select('shopping_carts.qty', 'products.name', 'products.image', 'products.slug',
          'sizes.size', 'colors.color', 'product_attr.price', 'products.id as pid', 'product_attr.id as attr_id')
         ->get();

          return view('frontEnd.cart', compact('cart_data'));
    }

}
