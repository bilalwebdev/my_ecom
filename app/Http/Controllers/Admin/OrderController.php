<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
   public function index()
   {
       $orders = Order::all();
       return view('admin.orders', compact('orders'));
   }
   public function orderDetails(Request $request, $id)
   {
    $order_details = DB::table('order_details')
    ->leftJoin('orders', 'orders.id', '=', 'order_details.order_id')
    ->leftJoin('products', 'products.id', '=', 'order_details.product_id')
    ->leftJoin('product_attr', 'product_attr.id', '=', 'order_details.product_attr_id')
    ->leftjoin('sizes', 'sizes.id', '=', 'product_attr.size_id')
    ->leftjoin('colors', 'colors.id', '=', 'product_attr.color_id')
    ->where(['orders.id' => $id])
    //->where(['orders.customer_id' => $request->session()->get('FRONT_USER_ID')])
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
///// dd($order_details);
   $order_status = ['Placed', 'Pending', 'Dispatched', 'Delivered', 'Failed'];
   $payment_status = ['Pending', 'Successful', 'Failed'];
   return view('admin.order-details', compact('order_details', 'order_status', 'payment_status'));
   }

   public function orderStatusChange($status, $id){
     Order::where('id', $id)->update(
         [
             'order_status' => $status
         ]
         );
         return redirect('/admin/order-details/'.$id);
   }
   public function orderPaymentChange($status, $id){
    Order::where('id', $id)->update(
        [
            'payment_status' => $status
        ]
        );
        return redirect('/admin/order-details/'.$id);
  }
  public function orderTrackDetails($id, Request $request){
    Order::where('id', $id)->update(
        [
            'track_details' => $request->track_details
        ]
        );
        return redirect('/admin/order-details/'.$id);
  }
}
