<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\HomeBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class HomeBannerController extends Controller
{
    public function banner()
    {
       $home_banners = HomeBanner::all();
       $data = compact('home_banners');
       return view('admin.banner')->with($data);
    }
    public function manage_banner()
    {
       $url = url('admin/manage-banner-process');
       $banner = new HomeBanner;
       $button = "Submit";
       $home_banners = DB::table('home_banners')->where(['status'=>1])->get();
       $data = compact('url', 'banner', 'button', 'home_banners');
       return view('admin.manage-banner')->with($data);
    }
    public function manage_banner_process(Request $req)
    {
       $req->validate(
           ['btn_text' => 'required',
           'btn_link' => 'required|unique:home_banners',
           'image' => 'required'
           ]
       );

       $banner = new HomeBanner();
       $banner->btn_text = $req['btn_text'];
       $banner->btn_link = $req['btn_link'];
       $banner->tag_line = $req['tag_line'];
       $banner->banner_heading = $req['banner_heading'];
       $banner->banner_desc = $req['banner_desc'];
       $banner->image = $req['image'];
       if($req->hasFile('image'))
      {
          $image = $req['image'];
          $ext = $image->extension();
          $image_name = time().'.'.$ext;
          $image->storeAs('/public/media/banner', $image_name);
          $banner->image = $image_name;
       }
       $banner->status=1;
       $banner->save();
       $req->session()->flash('message', 'HomeBanner inserted successfuly ');
       return redirect('admin/banner');

    }
    public function delete(Request $req, $id)
     {
        $arrImg = DB::table('home_banners')->where(['id' => $id])->get();
        if( Storage::exists('/public/media/banner/'.$arrImg[0]->image))
        {
            Storage::delete('/public/media/banner/'.$arrImg[0]->image);
        }
        DB::table('home_banners')->delete($id);
        return redirect('admin/banner');
     }
     public function edit($id)
     {
         $banner = HomeBanner::find($id);
         if(is_null($banner))
         {
             return redirect('admin/banner');
         }
         else{
            $home_banners = DB::table('home_banners')->where(['status'=>1])->where('id', '!=', $id)->get();
             $url = url('admin/manage-banner/update')."/". $id;
             $button = "Update";
             $data = compact('banner', 'url', 'button','home_banners');
             return view('admin.manage-banner')->with($data);
         }
     }
     public function update($id, Request $req)
     {
         $req->validate(
           ['btn_text' => 'required',
           'btn_link' => 'required',
           'image' => 'required'
          ]
       );
        $banner =  HomeBanner::find($id);
        $banner->btn_text = $req['btn_text'];
        $banner->btn_link = $req['btn_link'];
        $banner->tag_line = $req['tag_line'];
        $banner->banner_heading = $req['banner_heading'];
        $banner->banner_desc = $req['banner_desc'];
        if($req->hasFile('image'))
       {
           $arrImg = DB::table('home_banners')->where(['id' => $id])->get();
           Storage::delete('/public/media/banner/'.$arrImg[0]->image);
           $image = $req['image'];
           $ext = $image->extension();
           $image_name = time().'.'.$ext;
           $image->storeAs('/public/media/banner/', $image_name);
           $banner->image = $image_name;
        }
        $banner->save();
        $req->session()->flash('message', 'HomeBanner updated successfuly ');
        return redirect('admin/banner');
     }
     public function status(Request $req, $status, $id)
     {
        $banner = HomeBanner::find($id);
        $banner->status = $status;
        $banner->save();
        $req->session()->flash('message', 'HomeBanner status updated');
        return redirect('admin/banner');
     }

}
