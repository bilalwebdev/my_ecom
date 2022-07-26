<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Category;
use Illuminate\Cache\RedisTaggedCache;
use App\Http\Controllers\Admin\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function category()
    {
       $categories = Category::all();
       $data = compact('categories');
       return view('admin.category')->with($data);
    }
    public function manage_category()
    {
       $url = url('admin/manage-category-process');
       $category = new Category;
       $button = "Submit";
       $categories = DB::table('categories')->where(['status'=>1])->get();
       $data = compact('url', 'category', 'button', 'categories');
       return view('admin.manage-category')->with($data);
    }
    public function manage_category_process(Request $req)
    {
       $req->validate(
           ['category_name' => 'required',
           'category_slug' => 'required|unique:categories',
          // 'category_image' => 'required',
           'parent_category_id' => 'required']
       );

       $category = new Category();
       $category->category_name = $req['category_name'];
       $category->category_slug = $req['category_slug'];
       $category->parent_category_id = $req['parent_category_id'];
       if($req->hasFile('category_image'))
      {
          $image = $req['category_image'];
          $ext = $image->extension();
          $image_name = time().'.'.$ext;
          $image->storeAs('/public/media/category', $image_name);
          $category->category_image = $image_name;
       }
       if($req['is_home']!= NULL)
       {
           $category->is_home = 1;
       }
       $category->status=1;
       $category->save();
       $req->session()->flash('message', 'Category inserted successfuly ');
       return redirect('admin/category');

    }
    public function delete(Request $req, $id)
     {
        $arrImg = DB::table('categories')->where(['id' => $id])->get();
        if( Storage::exists('/public/media/category/'.$arrImg[0]->category_image))
        {
            Storage::delete('/public/media/category/'.$arrImg[0]->category_image);
        }
        DB::table('categories')->delete($id);
        return redirect('admin/category');
     }
     public function edit($id)
     {
         $category = Category::find($id);
         if(is_null($category))
         {
             return redirect('admin/category');
         }
         else{
            $categories = DB::table('categories')->where(['status'=>1])->where('id', '!=', $id)->get();
             $url = url('admin/manage-category/update')."/". $id;
             $button = "Update";
             $data = compact('category', 'url', 'button','categories');
             return view('admin.manage-category')->with($data);
         }
     }
     public function update($id, Request $req)
     {
         $req->validate(
           ['category_name' => 'required',
           'category_slug' => 'required',
          // 'category->parent_category_id' => 'required'
          ]
       );
        $category =  Category::find($id);
        $category->category_name = $req['category_name'];
        $category->category_slug = $req['category_slug'];
        $category->parent_category_id = $req['parent_category_id'];
        if($req->hasFile('category_image'))
       {
           $arrImg = DB::table('categories')->where(['id' => $id])->get();
           Storage::delete('/public/media/category/'.$arrImg[0]->category_image);
           $image = $req['category_image'];
           $ext = $image->extension();
           $image_name = time().'.'.$ext;
           $image->storeAs('/public/media/category/', $image_name);
           $category->category_image = $image_name;
        }
        if($req['is_home']!= NULL)
        {
            $category->is_home = 1;
        }
        else
        {
            $category->is_home = 0;
        }
        $category->save();
        $req->session()->flash('message', 'Category updated successfuly ');
        return redirect('admin/category');
     }
     public function status(Request $req, $status, $id)
     {
        $category = Category::find($id);
        $category->status = $status;
        $category->save();
        $req->session()->flash('message', 'Category status updated');
        return redirect('admin/category');
     }

}
