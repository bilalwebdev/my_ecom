<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Customer;
use App\Http\Controllers\Admin\Controller;
use Illuminate\Http\Request;

class CustomerController extends Controller
{

    public function customer()
    {
       $customers = Customer::all();
       $data = compact('customers');
       return view('admin.customer')->with($data);
    }
    public function show($id)
    {
       $customer = Customer::find($id);
       $data = compact('customer');
       return view('admin.show-customer')->with($data);
    }
    // public function manage_customer_process(Request $req)
    // {
    //    $req->validate(
    //        [ 'customer' => 'required|unique:customers']
    //    );

    //    $customer = new Customer();
    //    $customer->customer = $req['customer'];
    //    $customer->save();
    //    $req->session()->flash('message', 'Customer inserted successfuly ');
    //    return redirect('admin/customer');

    // }
    // public function delete(Customer $id)
    //  {
    //      $id->delete();
    //      return redirect('admin/customer');
    //  }
    //  public function edit($id)
    //  {
    //      $customer = customer::find($id);
    //      if(is_null($customer))
    //      {
    //          return redirect('admin/customer');
    //      }
    //      else{
    //          $url = url('admin/manage-customer/update')."/". $id;
    //          $button = "Update";
    //          $data = compact('customer', 'url', 'button');
    //          return view('admin.manage-customer')->with($data);
    //      }
    //  }
     public function update($id, Request $req)
     {
        $req->validate(
            ['customer' => 'required|unique:customers,customer,'.$id]
        );
        $customer =  Customer::find($id);
        $customer->customer = $req['customer'];
        $customer->status=1;
        $customer->save();
        $req->session()->flash('message', 'Customer updated successfuly ');
        return redirect('admin/customer');
     }
     public function status(Request $req, $status, $id)
     {
        $customer = Customer::find($id);
        $customer->status = $status;
        $customer->save();
        $req->session()->flash('message', 'Customer status updated');
        return redirect('admin/customer');
     }
}
