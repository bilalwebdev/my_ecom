<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Size;
use App\Http\Controllers\Admin\Controller;
use Illuminate\Http\Request;


class SizeController extends Controller
{

    public function size()
    {
       $sizes = Size::all();
       $data = compact('sizes');
       return view('admin.size')->with($data);
    }
    public function manage_size()
    {
       $url = url('admin/manage-size-process');
       $size = new Size;
       $button = "Submit";
       $data = compact('url', 'size', 'button');
       return view('admin.manage-size')->with($data);
    }
    public function manage_size_process(Request $req)
    {
       $req->validate(
           [ 'size' => 'required|unique:sizes']
       );

       $size = new Size();
       $size->size = $req['size'];
       $size->status=1;
       $size->save();
       $req->session()->flash('message', 'Size inserted successfuly ');
       return redirect('admin/size');

    }
    public function delete(Size $id)
     {
         $id->delete();
         return redirect('admin/size');
     }
     public function edit($id)
     {
         $size = Size::find($id);
         if(is_null($size))
         {
             return redirect('admin/size');
         }
         else{
             $url = url('admin/manage-size/update')."/". $id;
             $button = "Update";
             $data = compact('size', 'url', 'button');
             return view('admin.manage-size')->with($data);
         }
     }
     public function update($id, Request $req)
     {
        $req->validate(
            ['size' => 'required|unique:sizes,size,'.$id]
        );
        $size =  Size::find($id);
        $size->size = $req['size'];
        $size->status=1;
        $size->save();
        $req->session()->flash('message', 'Size updated successfuly ');
        return redirect('admin/size');
     }
     public function status(Request $req, $status, $id)
     {
        $size = Size::find($id);
        $size->status = $status;
        $size->save();
        $req->session()->flash('message', 'Size status updated');
        return redirect('admin/size');
     }
}
