<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Front\Controller;
use App\Models\Admin\Category;
use App\Models\Admin\Color;
use App\Models\Admin\Coupon;
use App\Models\Admin\Customer;
use App\Models\Admin\Product;
use App\Models\Order;
use App\Models\ShoppingCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

use function Ramsey\Uuid\v1;
use function Symfony\Component\VarDumper\Dumper\esc;

class FrontController extends Controller
{
    public function index(Request $request)
    {

        $arr['home_categories'] = DB::table('categories')
            ->where(['status' => 1])
            ->where(['is_home' => 1])
            ->get();
        //   dd( $arr['home_categories']);
        if (isset($arr['home_categories'])) {
            foreach ($arr['home_categories'] as $category) {
                $arr['home_categories_product'][$category->id] = DB::table('products')
                    ->where(['status' => 1])
                    ->where(['category_id' => $category->id])
                    ->get();
                foreach ($arr['home_categories_product'][$category->id] as $product) {
                    $arr['home_product_attr'][$product->id]  = DB::table('product_attr')
                        ->leftjoin('sizes', 'sizes.id', '=', 'product_attr.size_id')
                        ->leftjoin('colors', 'colors.id', '=', 'product_attr.color_id')
                        ->where(['product_attr.products_id' => $product->id])
                        ->get();
                }
            }
            $arr['home_featured_product'][0] = DB::table('products')
                ->where(['status' => 1])
                ->where(['is_featured' => 1])
                //->where(['category_id'=>$list->id])
                ->get();
            foreach ($arr['home_featured_product'][0] as $featured) {
                $arr['home_featured_product_attr'][$featured->id]  = DB::table('product_attr')
                    ->leftjoin('sizes', 'sizes.id', '=', 'product_attr.size_id')
                    ->leftjoin('colors', 'colors.id', '=', 'product_attr.color_id')
                    ->where(['product_attr.products_id' => $featured->id])
                    ->get();
            }
            $arr['home_tranding_product'][0] = DB::table('products')
                ->where(['status' => 1])
                ->where(['is_tranding' => 1])
                //->where(['category_id'=>$list->id])
                ->get();
            foreach ($arr['home_tranding_product'][0] as $trandng_product) {
                $arr['home_tranding_product_attr'][$trandng_product->id]  = DB::table('product_attr')
                    ->leftjoin('sizes', 'sizes.id', '=', 'product_attr.size_id')
                    ->leftjoin('colors', 'colors.id', '=', 'product_attr.color_id')
                    ->where(['product_attr.products_id' => $trandng_product->id])
                    ->get();
            }
            $arr['home_discounted_product'][0] = DB::table('products')
                ->where(['status' => 1])
                ->where(['is_discounted' => 1])
                //]->where(['category_id'=>$list->id])
                ->get();
            foreach ($arr['home_discounted_product'][0] as $discounted_product) {
                $arr['home_discounted_product_attr'][$discounted_product->id]  = DB::table('product_attr')
                    ->leftjoin('colors', 'colors.id', '=', 'product_attr.color_id')
                    ->leftjoin('sizes', 'sizes.id', '=', 'product_attr.size_id')
                    ->where(['product_attr.products_id' => $discounted_product->id])
                    ->get();
            }

            // dd($arr);
        }
        $arr['home_brands'] = DB::table('brands')
            ->where(['status' => 1])
            ->where(['is_home' => 1])
            ->get();
        $arr['home_banners'] = DB::table('home_banners')
            ->where(['status' => 1])
            ->get();

        return view('frontEnd.index', $arr);
    }
    public function product(Request $request, $slug)
    {
        $arr['product'] = DB::table('products')
            ->where(['status' => 1])
            ->where(['slug' => $slug])
            ->get();
        foreach ($arr['product'] as $product_detail) {
            $arr['product_attr'][$product_detail->id]  = DB::table('product_attr')
                ->leftjoin('sizes', 'sizes.id', '=', 'product_attr.size_id')
                ->leftjoin('colors', 'colors.id', '=', 'product_attr.color_id')
                ->where(['product_attr.products_id' => $product_detail->id])
                ->get();
            $arr['product_images'][$product_detail->id]  = DB::table('product_images')
                ->where(['product_images.products_id' => $product_detail->id])
                ->get();
        }
        $arr['related_product'] = DB::table('products')
            ->where(['status' => 1])
            ->where('slug', "!=", $slug)
            ->where(['category_id' => $arr['product'][0]->category_id])
            ->get();
        foreach ($arr['related_product'] as $related_product) {
            $arr['related_product_attr'][$related_product->id]  = DB::table('product_attr')
                ->leftjoin('sizes', 'sizes.id', '=', 'product_attr.size_id')
                ->leftjoin('colors', 'colors.id', '=', 'product_attr.color_id')
                ->where(['product_attr.products_id' => $related_product->id])
                ->get();
        }
        $arr['product_reviews'] = DB::table('product_reviews')
        ->leftJoin('products', 'products.id', '=', 'product_reviews.product_id')
        ->leftJoin('customers', 'customers.id', '=', 'product_reviews.customer_id')
        ->orderBy('product_reviews.added_on', 'desc')
        ->where('products.slug' , $slug)
        ->where('product_reviews.status' , 1)
        ->select('customers.name', 'product_reviews.*')
        ->get();

     ////   dd($arr['product_reviews']);
        return view('frontEnd.product', $arr);
    }

    public function addToCart(Request $request)
    {
       // dd($request);
        if ($request->session()->has('FRONT_USER_LOGIN')) {
            $user_id = $request->session()->get('FRONT_USER_ID');
            $user_type = "Reg";
        } else {
            $user_id = getUserTempId();
            $user_type = "Non-Reg";
        }
        $size_id = $request['size'];
        $color_id = $request['color'];
        $pqty = $request['pqty'];
        $product_id = $request['product_id'];


        $result =  DB::table('product_attr')
            ->select('product_attr.id')
            ->leftjoin('sizes', 'sizes.id', '=', 'product_attr.size_id')
            ->leftjoin('colors', 'colors.id', '=', 'product_attr.color_id')
            ->where(['products_id' => $product_id])
            ->where(['colors.color' => $color_id])
            ->where(['sizes.size' => $size_id])
            ->get();

        $product_attr_id = $result[0]->id;

         $available_qty = getAvailableQty($product_id, $product_attr_id);
        if(isset($available_qty[0]))
        {
            $final_qty = $available_qty[0]->pqty - $available_qty[0]->qty;
            if($pqty>$final_qty)
            {
               return response()->json(["msg" => 'not', "data" => "Only $final_qty available"]);
            }
        }
      //   dd($final_qty);
        $check = DB::table('shopping_carts')
            ->where(['user_id' => $user_id])
            ->where(['user_type' => $user_type])
            ->where(['product_id' => $product_id])
            ->where(['product_attr_id' => $product_attr_id])
            ->get();

        if (isset($check[0])) {
            $update_id = $check[0]->id;
            if ($pqty == 0) {
                DB::table('shopping_carts')
                    ->where(['id' => $update_id])
                    ->delete();
                $msg = "Deleted";
            } else {
                $update_id = $check[0]->id;
                DB::table('shopping_carts')
                    ->where(['id' => $update_id])
                    ->update(['qty' => $pqty]);
                $msg = "Updated";
            }
        } else {
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
            ->leftjoin('sizes', 'sizes.id', '=', 'product_attr.size_id')
            ->leftjoin('colors', 'colors.id', '=', 'product_attr.color_id')
            ->where(['user_id' => $user_id])
            ->where(['user_type' => $user_type])
            ->select(
                'shopping_carts.qty',
                'products.name',
                'products.image',
                'products.slug',
                'sizes.size',
                'colors.color',
                'product_attr.price',
                'products.id as pid',
                'product_attr.id as attr_id'
            )
            ->get();
        $total_items = count($cart_data);
        return response()->json(["msg" => $msg, "data" => $cart_data,  "t_items" => $total_items]);
    }


    public function showCart(Request $request)
    {
        if ($request->session()->has('FRONT_USER_LOGIN')) {
            $user_id = $request->session()->get('FRONT_USER_ID');
            $user_type = "Reg";
        } else {
            $user_id = getUserTempId();
            $user_type = "Non-Reg";
        }

        $cart_data = DB::table('shopping_carts')
            ->leftJoin('products', 'products.id', '=', 'shopping_carts.product_id')
            ->leftJoin('product_attr', 'product_attr.id', '=', 'shopping_carts.product_attr_id')
            ->leftjoin('sizes', 'sizes.id', '=', 'product_attr.size_id')
            ->leftjoin('colors', 'colors.id', '=', 'product_attr.color_id')
            ->where(['user_id' => $user_id])
            ->where(['user_type' => $user_type])
            ->select(
                'shopping_carts.qty',
                'products.name',
                'products.image',
                'products.slug',
                'sizes.size',
                'colors.color',
                'product_attr.price',
                'products.id as pid',
                'product_attr.id as attr_id'
            )
            ->get();

        return view('frontEnd.cart', compact('cart_data'));
    }

    public function showCategory(Request $request, $slug)
    {
        $sort = $request->get('sort');
        $min_price = $request->get('min_price');
        $max_price = $request->get('max_price');
        $color_id = $request->get('pro_color_id');
        $colorFilterArr = [];
        $cat_data = Category::where('category_slug', $slug)->first();
        $query = DB::table('products');
        $query = $query->leftJoin('product_attr', 'product_attr.products_id', '=', 'products.id');
        $query = $query->where(['category_id' => $cat_data->id]);
        if ($sort == "name") {
            $query = $query->orderBy('name', 'ASC');
        }
        if ($sort == "date") {
            $query = $query->orderBy('products.id', 'desc');
        }
        if ($sort == "price_asc") {

            $query = $query->orderBy('product_attr.price', 'ASC');
        }
        if ($sort == "price_desc") {
            $query = $query->orderBy('product_attr.price', 'DESC');
        }
        if ($min_price > 0 || $max_price > 0) {
            $query = $query->whereBetween('product_attr.price', [$min_price, $max_price]);
        }
        if ($color_id) {
            $colorFilterArr = explode(':', $color_id);
            $colorFilterArr = array_filter($colorFilterArr);
            $query =  $query->where(['product_attr.color_id' => $color_id]);
        }
        $query = $query->distinct()->select('products.*', "product_attr.price");
        $query = $query->paginate(10);

        $arr['products'] = $query;

        //dd($arr['products']);
        foreach ($arr['products'] as $category_product) {
            $query1 = DB::table('product_attr');
            $query1 = $query1->leftjoin('colors', 'colors.id', '=', 'product_attr.color_id');
            $query1 = $query1->leftjoin('sizes', 'sizes.id', '=', 'product_attr.size_id');
            $query1 = $query1->where(['product_attr.products_id' => $category_product->id]);
            $query1 = $query1->get();
            $arr['category_product_attr'][$category_product->id] = $query1;
        }
        $arr['colors'] = Color::where('status', 1)->get();
        $arr['categories'] = Category::where('status', 1)->get();
        $arr['slug'] = $slug;
        $arr['color_val'] = $color_id;
        $arr['colorFilterArr'] = $colorFilterArr;
        $arr['max_price'] = $max_price;
        $arr['min_price'] = $min_price;
        return view('frontend.category', $arr);
    }
    public function search($str)
    {

        $query = DB::table('products');
        $query = $query->leftJoin('product_attr', 'product_attr.products_id', '=', 'products.id');
        $query = $query->where(['status' => 1]);
        $query = $query->where('name', 'like', "%$str%");
        $query = $query->orwhere('model', 'like', "%$str%");
        $query = $query->orwhere('short_desc', 'like', "%$str%");
        $query = $query->orwhere('desc', 'like', "%$str%");
        $query = $query->orwhere('keywords', 'like', "%$str%");
        $query = $query->orwhere('technical_specifications', 'like', "%$str%");
        $query = $query->distinct()->select('products.*');
        $query = $query->get();

        $arr['products'] = $query;
        foreach ($arr['products'] as $category_product) {
            $query1 = DB::table('product_attr');
            $query1 = $query1->leftjoin('colors', 'colors.id', '=', 'product_attr.color_id');
            $query1 = $query1->leftjoin('sizes', 'sizes.id', '=', 'product_attr.size_id');
            $query1 = $query1->where(['product_attr.products_id' => $category_product->id]);
            $query1 = $query1->get();
            $arr['category_product_attr'][$category_product->id] = $query1;
        }

        return view('frontend.search', $arr);
    }

    public function registration(Request $request)
    {
        if ($request->session()->has('FRONT_USER_LOGIN')) {
            return redirect('/');
        } else {
            return view('frontEnd.register');
        }
    }
    public function registrationProcess(Request $request)
    {
        $rand_id = rand(111111111, 999999999);
        $request->validate(
            [
                'username' => 'required',
                'email' => 'unique:customers|email:filter,rfc,spoof',
                'mobile' => 'required',
                'password' => 'required|min:8',
                'confirm_password' => 'required|same:password'
            ]
        );
        Customer::create([
            'name' => $request['username'],
            'email' => $request['email'],
            'mobile' => $request['mobile'],
            'status' => '1',
            'is_verify' => '0',
            'rand_id' => $rand_id,
            'password' => Hash::make($request['password'])
        ]);

        $data = ['name' => $request['username'], 'rand_id' => $rand_id];
        $user['to'] = $request['email'];
        Mail::send('frontEnd/email_verification', $data, function ($messages) use ($user) {
            $messages->to($user['to']);
            $messages->subject('Email Verification');
        });



        $request->session()->flash('message', 'Registered successfuly! Please check your email for verification. Thank you :) ');
        return redirect('/register');
    }
    public function login(Request $request)
    {
        $user = Customer::where('email', $request->email)->get();
        if (isset($user[0])) {
            if (Hash::check($request->password, $user[0]->password)) {
                if ($request->remember_me) {
                    setcookie('login_email', $request->email, time() + 60 * 60 * 24 * 100);
                    setcookie('login_password', $request->password, time() + 60 * 60 * 24 * 100);
                } else {
                    setcookie('login_email', $request->email, 100);
                    setcookie('login_password', $request->password, 100);
                }
                $request->session()->put('FRONT_USER_LOGIN', true);
                $request->session()->put('FRONT_USER_ID', $user[0]->id);
                $request->session()->put('FRONT_USER_NAME', $user[0]->name);
                $status = "success";
                $msg = "";
                $user_id = getUserTempId();
                DB::table('shopping_carts')
                    ->where([
                        'user_id' => $user_id,
                        'user_type' => 'Non-Reg'
                    ])
                    ->update(
                        [
                            'user_id' => $user[0]->id,
                            'user_type' => 'Reg'
                        ]
                    );
            } else {
                $status = "error";
                $msg = "Please enter valid password!";
            }
        } else {
            $status = "error";
            $msg = "Please enter valid email address!";
        }
        return response()->json(["msg" => $msg, "status" => $status]);
    }
    public function forgot_password(Request $request)
    {
        $rand_id = rand(111111111, 999999999);
        $user = Customer::where('email', $request->email)->get();
        if (isset($user[0])) {
            $data = ['name' => $request['username'], 'rand_id' => $rand_id];
            $user['to'] = $request['email'];
            Mail::send('frontEnd/forgot_password', $data, function ($messages) use ($user) {
                $messages->to($user['to']);
                $messages->subject('Forgot Password');
            });
        } else {
            $status = "error";
            $msg = "Please enter valid email address!";
        }
        return response()->json(["msg" => $msg, "status" => $status]);
    }
    public function checkout(Request $request)
    {
        $arr['cart_items'] = getCartItems();
        if(isset( $arr['cart_items'][0]))
        {
            if ($request->session()->has('FRONT_USER_LOGIN'))
            {
                $user_id = $request->session()->get('FRONT_USER_ID');
               $customer_info = Customer::where('id', $user_id)->get();
               $arr['customers']['name'] = $customer_info[0]->name;
               $arr['customers']['email'] = $customer_info[0]->email;
               $arr['customers']['mobile'] = $customer_info[0]->mobile;
               $arr['customers']['country'] = $customer_info[0]->country;
               $arr['customers']['address'] = $customer_info[0]->address;
               $arr['customers']['zip'] = $customer_info[0]->zip;
               $arr['customers']['state'] = $customer_info[0]->state;
               $arr['customers']['city'] = $customer_info[0]->city;
            }
            else
            {
               $arr['customers']['name'] = '';
               $arr['customers']['email'] = '';
               $arr['customers']['mobile'] = '';
               $arr['customers']['country'] = '';
               $arr['customers']['address'] = '';
               $arr['customers']['zip'] = '';
               $arr['customers']['state'] = '';
               $arr['customers']['city'] = '';
            }
           return view('frontEnd.checkout', $arr);
        }
        else{
           return redirect('/');
        }
    }
    public function applyCoupon(Request $request)
    {
         $arr = applyCouponCode($request->coupon_code);
         $arr = json_decode($arr, true);
       return response()->json(["msg" => $arr['msg'], "status" => $arr['status'], "total_price" => $arr['total_price']]);
    }
    public function removeCoupon(Request $request)
    {
        $total_price = 0;
        $cart_items = getCartItems();
        foreach($cart_items as $item)
        {
           $total_price+=($item->qty*$item->price);
        }
       // $coupon_code = Coupon::where('code', $request->coupon_code)->get();
        return response()->json(["msg" => 'Coupon removed', "status" => 'success', "total_price" => $total_price]);
    }
    public function placeOrder(Request $request)
    {
        $rand_id = rand(111111111, 999999999);
        if ($request->session()->has('FRONT_USER_LOGIN'))
        {





        }
        else
        {
            $valid = Validator::make($request->all(),
            [
                "email" => 'required|email|unique:customers,email'
            ]);
            if($valid->passes())
            {
                $user = Customer::create([
                    'name' => $request['name'],
                    'email' => $request['email'],
                    'mobile' => $request['mobile'],
                    'status' => '1',
                    'is_verify' => '0',
                    'rand_id' => $rand_id,
                    'password' => Hash::make('12345678')
                ]);
                $request->session()->put('FRONT_USER_LOGIN', true);
                $request->session()->put('FRONT_USER_ID', $user->id);
                $request->session()->put('FRONT_USER_NAME', $request['name']);

                $user_id = getUserTempId();
                DB::table('shopping_carts')
                    ->where([
                        'user_id' => $user_id,
                        'user_type' => 'Non-Reg'
                    ])
                    ->update(
                        [
                            'user_id' => $user->id,
                            'user_type' => 'Reg'
                        ]
                    );
                    $status = "success";
                    $msg = "Order Placed!";
            }
            else{

                return response()->json(["msg" => "Email is already been taken! Please Login to you account", "status" => 'error']);
            }

        }
        $coupon_value=0;
        if($request->coupon_code)
            {
                $arr = applyCouponCode($request->coupon_code);
                $arr = json_decode($arr, true);
                if($arr['status'] == 'success')
                {
                  $coupon_value = $arr['coupon_code_value'];
                }
                else
                {
                    return response()->json(["msg" => $arr['msg'], "status" => 'error']);
                }
            }

            $user_id = $request->session()->get('FRONT_USER_ID');
            $name = $request->name;
            $email = $request->email;
            $mobile = $request->mobile;
            $city = $request->city;
            $district = $request->district;
            $address = $request->address;
            $zip = $request->zip;
            $coupon_code = $request->coupon_code;
            $payment_type = $request->payment_type;
            $total_price = 0;
            $cart_items = getCartItems();
            foreach($cart_items as $item)
            {
               $total_price+=($item->qty*$item->price);

            }


            $order = new Order();
            $order->username = $name;
            $order->email = $email;
            $order->city = $city;
            $order->mobile = $mobile;
            $order->address = $address;
            $order->district = $district;
            $order->coupon_code = $coupon_code;
            $order->coupon_value = $coupon_value;
            $order->pin_code = $zip;
            $order->payment_type = $payment_type;
            $order->customer_id = $user_id;
            $order->total_amt = $total_price;
            $order->added_on = date('Y-m-d h:i:s');
            $order->payment_status = 'Pending';
            $order->order_status = 'Placed';
            $order->save();
             if($order->id>0)
             {
                $productDetailsArr=[];
                $i=0;
                foreach($cart_items as $item)
                {

                   $productDetailsArr['product_id'] = $item->pid;
                   $productDetailsArr['product_attr_id'] = $item->attr_id;
                   $productDetailsArr['price'] = $item->price;
                   $productDetailsArr['qty'] = $item->qty;
                   $productDetailsArr['order_id'] = $order->id;
                   $i++;
                   DB::table('order_details')->insert($productDetailsArr);
                }

                ShoppingCart::where('user_id', $user_id)->delete();
                $request->session()->put('ORDER_ID', $order->id);
                $status = "success";
                $msg = "Order Placed!";
             }
             else{
                $status = "error";
                $msg = "Please try after sometime!";
             }

        return response()->json(["msg" => $msg, "status" => $status]);

    }

    public function orderPlaced(Request $request)
    {
        if($request->session()->has('ORDER_ID'))
        {

           return view('frontEnd.order-placed');
        }
        else{
           return redirect('/');
        }
        $request->session()->forget('ORDER_ID');

    }
    public function myOrders(Request $request)
    {
        $user_id = $request->session()->get('FRONT_USER_ID');
       $orders = Order::where('customer_id', $user_id)->get();
        return view('frontEnd.my-orders', compact('orders'));
    }

    public function orderDetails(Request $request, $id)
    {

     $order_details = DB::table('orders')
        ->leftJoin('order_details', 'order_details.order_id', '=', 'orders.id')
        ->leftJoin('products', 'products.id', '=', 'order_details.product_id')
        ->leftJoin('product_attr', 'product_attr.id', '=', 'order_details.product_attr_id')
        ->leftjoin('sizes', 'sizes.id', '=', 'product_attr.size_id')
        ->leftjoin('colors', 'colors.id', '=', 'product_attr.color_id')
        ->where(['orders.id' => $id])
        ->where(['orders.customer_id' => $request->session()->get('FRONT_USER_ID')])
        ->select(
            'order_details.*',
            'orders.*',
            'products.name',
            'products.image',
            'products.slug',
            'sizes.size',
            'colors.color',
            'product_attr.price',
            'products.id as pid',
            'product_attr.id as attr_id'
        )
       ->get();
      // dd($order_details);
       if(!isset($order_details[0]))
       {
           return redirect('/');
       }

       return view('frontEnd.order-details', compact('order_details'));
    }

    public function productReview(Request $request)
    {
        if($request->session()->get('FRONT_USER_LOGIN'))
        {
            DB::table('product_reviews')->insert(
                [
                    'product_id' => $request->product_id,
                    'customer_id' => $request->session()->get('FRONT_USER_ID'),
                    'rating' => $request->rating,
                    'review' => $request->review,
                    'status' => '1',
                    'added_on' => now()
                ]
                );
                $status = "success";
                $msg = "Your review has been submitted successfully!";
        }
        else{
            $status = "error";
            $msg = "Please login to review!";
        }
        return response()->json(["msg" => $msg, "status" => $status]);

    }
}
