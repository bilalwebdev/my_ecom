<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Brand;
use App\Http\Controllers\Admin\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
    public function brand()
    {
       $brands = Brand::all();
       $data = compact('brands');
       return view('admin.brand')->with($data);
    }
    public function manage_brand()
    {
       $url = url('admin/manage-brand-process');
       $brand = new Brand;
       $button = "Submit";
       $is_home_show = " ";
       $data = compact('url', 'brand', 'button', 'is_home_show');
       return view('admin.manage-brand')->with($data);
    }
    public function manage_brand_process(Request $req)
    {
       $req->validate(
           [
            'brand_name' => 'required',
            //'brand_image' => 'required'
           ]
       );

       $brand = new Brand();
       $brand->brand_name = $req['brand_name'];
      // $brand->brand_image = $req['brand_image'];
      if($req->hasFile('brand_image'))
       {
           $image = $req['brand_image'];
           $ext = $image->extension();
           $image_name = time().'.'.$ext;
           $image->storeAs('/public/media/brands/', $image_name);
           $brand->brand_image = $image_name;
        }
        if($req['is_home']!= NULL)
        {
            $brand->is_home = 1;
        }
        else
        {
            $brand->is_home = 0;
        }
        $brand->status=1;
       $brand->save();
       $req->session()->flash('message', 'Brand inserted successfuly ');
       return redirect('admin/brand');

    }
    public function delete(Request $req, $id)
     {
        $arrImg = DB::table('brands')->where(['id' => $id])->get();
        if( Storage::exists('/public/media/brands/'.$arrImg[0]->brand_image))
        {
            Storage::delete('/public/media/brands/'.$arrImg[0]->brand_image);
        }
         DB::table('brands')->delete($id);
         return redirect('admin/brand');
     }
     public function edit($id)
     {
         $brand = Brand::find($id);
         if(is_null($brand))
         {
             return redirect('admin/brand');
         }
         else{
             if($brand->is_home == Null)
             {
                 $is_home_show = " ";
             }
             else{
                $is_home_show = "checked";
             }
             $url = url('admin/manage-brand/update')."/". $id;
             $button = "Update";
             $data = compact('brand', 'url', 'button', 'is_home_show');
             return view('admin.manage-brand')->with($data);
         }
     }
     public function update($id, Request $req)
     {
         $req->validate(
           ['brand_name' => 'required',
           //'brand_image' => 'required'
           ]
       );
        $brand =  Brand::find($id);
        $brand->brand_name = $req['brand_name'];
       // $brand->brand_image = $req['brand_image'];
       if($req->hasFile('brand_image'))
       {
           $arrImg = DB::table('brands')->where(['id' => $id])->get();
           Storage::delete('/public/media/brands/'.$arrImg[0]->brand_image);
           $image = $req['brand_image'];
           $ext = $image->extension();
           $image_name = time().'.'.$ext;
           $image->storeAs('/public/media/brands/', $image_name);
           $brand->brand_image = $image_name;
        }
        if($req['is_home']!= NULL)
        {
            $brand->is_home = 1;
        }
        else
        {
            $brand->is_home = 0;
        }
        $brand->save();
        $req->session()->flash('message', 'Brand updated successfuly ');
        return redirect('admin/brand');
     }
     public function status(Request $req, $status, $id)
     {
        $brand = Brand::find($id);
        $brand->status = $status;
        $brand->save();
        $req->session()->flash('message', 'Brand status updated');
        return redirect('admin/brand');
     }
}
