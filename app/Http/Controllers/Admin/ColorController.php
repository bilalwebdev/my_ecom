<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\Controller;
use App\Models\Admin\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function color()
    {
       $colors = Color::all();
       $data = compact('colors');
       return view('admin.color')->with($data);
    }
    public function manage_color()
    {
       $url = url('admin/manage-color-process');
       $color = new Color;
       $button = "Submit";
       $data = compact('url', 'color', 'button');
       return view('admin.manage-color')->with($data);
    }
    public function manage_color_process(Request $req)
    {
       $req->validate(
           [ 'color' => 'required|unique:colors']
       );

       $color = new Color();
       $color->status=1;
       $color->color = $req['color'];
       $color->save();
       $req->session()->flash('message', 'Color inserted successfuly ');
       return redirect('admin/color');

    }
    public function delete(Color $id)
     {
         $id->delete();
         return redirect('admin/color');
     }
     public function edit($id)
     {
         $color = Color::find($id);
         if(is_null($color))
         {
             return redirect('admin/color');
         }
         else{
             $url = url('admin/manage-color/update')."/". $id;
             $button = "Update";
             $data = compact('color', 'url', 'button');
             return view('admin.manage-color')->with($data);
         }
     }
     public function update($id, Request $req)
     {
        $req->validate(
            ['color' => 'required|unique:colors,color,'.$id]
        );
        $color =  color::find($id);
        $color->color = $req['color'];
        $color->status=1;
        $color->save();
        $req->session()->flash('message', 'Color updated successfuly ');
        return redirect('admin/color');
     }
     public function status(Request $req, $status, $id)
     {
        $color = color::find($id);
        $color->status = $status;
        $color->save();
        $req->session()->flash('message', 'Color status updated');
        return redirect('admin/color');
     }
}
