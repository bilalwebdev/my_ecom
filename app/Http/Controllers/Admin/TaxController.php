<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Tax;
use App\Http\Controllers\Admin\Controller;
use Illuminate\Http\Request;

class TaxController extends Controller
{
    public function tax()
    {
       $taxes = Tax::all();
       $data = compact('taxes');
       return view('admin.tax')->with($data);
    }
    public function manage_tax()
    {
       $url = url('admin/manage-tax-process');
       $tax = new Tax;
       $button = "Submit";
       $data = compact('url', 'tax', 'button');
       return view('admin.manage-tax')->with($data);
    }
    public function manage_tax_process(Request $req)
    {
       $req->validate(
           [
           'tax_value' => 'required|unique:taxes',
           'tax_desc' => 'required'
           ]
       );

       $tax = new Tax();
       $tax->tax_value = $req['tax_value'];
       $tax->tax_desc = $req['tax_desc'];
       $tax->status = 1;
       $tax->save();
       $req->session()->flash('message', 'Tax inserted successfuly ');
       return redirect('admin/tax');
    }
    public function delete(Tax $id)
     {
         $id->delete();
         return redirect('admin/tax');
     }
     public function edit($id)
     {
         $tax = Tax::find($id);
         if(is_null($tax))
         {
             return redirect('admin/tax');
         }
         else{
             $url = url('admin/manage-tax/update')."/". $id;
             $button = "Update";
             $data = compact('tax', 'url', 'button');
             return view('admin.manage-tax')->with($data);
         }
     }
     public function update($id, Request $req)
     {
        $req->validate(
            ['tax_value' => 'required|unique:taxes,tax_value,'.$id]
        );
        $tax =  Tax::find($id);
        $tax->tax_value = $req['tax_value'];
        $tax->tax_desc = $req['tax_desc'];
        $tax->save();
        $req->session()->flash('message', 'Tax updated successfuly ');
        return redirect('admin/tax');
     }
     public function status(Request $req, $status, $id)
     {
        $tax = Tax::find($id);
        $tax->status = $status;
        $tax->save();
        $req->session()->flash('message', 'Tax status updated');
        return redirect('admin/tax');
     }
}
