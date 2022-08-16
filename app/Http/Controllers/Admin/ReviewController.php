<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
{
    public function review()
    {
        $reviews = DB::table('product_reviews')
        ->leftJoin('products', 'products.id', '=', 'product_reviews.product_id')
        ->leftJoin('customers', 'customers.id', '=', 'product_reviews.customer_id')
        ->orderBy('product_reviews.added_on', 'desc')
        ->select('customers.name', 'product_reviews.*', 'products.name as p_name')
        ->get();
     // dd($reviews);
        return view('admin.review', compact('reviews'));
    }
    public function status(Request $req, $status, $id)
    {
       DB::table('product_reviews')
       ->where('id', $id)
       ->update(
           [
               'status' => $status
           ]
           );
    //   $req->session()->flash('message', 'Coupon status updated');
       return redirect('admin/review');
    }
}
