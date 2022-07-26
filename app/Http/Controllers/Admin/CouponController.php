<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Coupon;
use App\Http\Controllers\Admin\Controller;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function coupon()
    {
       $coupons = Coupon::all();
       $data = compact('coupons');
       return view('admin.coupon')->with($data);
    }
    public function manage_coupon()
    {
       $url = url('admin/manage-coupon-process');
       $coupon = new Coupon;
       $button = "Submit";
       $data = compact('url', 'coupon', 'button');
       return view('admin.manage-coupon')->with($data);
    }
    public function manage_coupon_process(Request $req)
    {
       $req->validate(
           ['title' => 'required',
           'code' => 'required|unique:coupons',
           'value' => 'required']
       );

       $coupon = new Coupon();
       $coupon->title = $req['title'];
       $coupon->code = $req['code'];
       $coupon->type = $req['type'];
       $coupon->min_order_amt = $req['min_order_amt'];
       $coupon->value = $req['value'];
       $coupon->is_one_time = $req['is_one_time'];
       $coupon->status = 1;
       $coupon->save();
       $req->session()->flash('message', 'Coupon inserted successfuly ');
       return redirect('admin/coupon');

    }
    public function delete(Coupon $id)
     {
         $id->delete();
         return redirect('admin/coupon');
     }
     public function edit($id)
     {
         $coupon = Coupon::find($id);
         if(is_null($coupon))
         {
             return redirect('admin/coupon');
         }
         else{
             $url = url('admin/manage-coupon/update')."/". $id;
             $button = "Update";
             $data = compact('coupon', 'url', 'button');
             return view('admin.manage-coupon')->with($data);
         }
     }
     public function update($id, Request $req)
     {
        $req->validate(
            ['title' => 'required',
            'code' => 'required|unique:coupons,code,'.$id,
            'value' => 'required']
        );
        $coupon =  Coupon::find($id);
        $coupon->title = $req['title'];
        $coupon->code = $req['code'];
        $coupon->type = $req['type'];
        $coupon->min_order_amt = $req['min_order_amt'];
        $coupon->value = $req['value'];
        $coupon->is_one_time = $req['is_one_time'];
        $coupon->save();
        $req->session()->flash('message', 'Coupon updated successfuly ');
        return redirect('admin/coupon');
     }
     public function status(Request $req, $status, $id)
     {
        $coupon = Coupon::find($id);
        $coupon->status = $status;
        $coupon->save();
        $req->session()->flash('message', 'Coupon status updated');
        return redirect('admin/coupon');
     }
}
