<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Product;
use App\Http\Controllers\Admin\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use phpDocumentor\Reflection\Types\Null_;

class ProductController extends Controller
{
    public function product()
    {
       $products = Product::all();
       $data = compact('products');
       return view('admin.product')->with($data);
    }
    public function manage_product()
    {
       $url = url('admin/manage-product-process');
       $product = new Product();
       $button = "Submit";
       $categories = DB::table('categories')->where(['status'=>1])->get();
       $sizes = DB::table('sizes')->where(['status'=>1])->get();
       $colors = DB::table('colors')->where(['status'=>1])->get();
       $brands = DB::table('brands')->where(['status'=>1])->get();
       $taxes = DB::table('taxes')->where(['status'=>1])->get();
                $productAttrArr['0']['id'] = ' ';
                $productAttrArr['0']['products_id'] = 0;
                $productAttrArr['0']['sku'] = ' ';
                $productAttrArr['0']['mrp'] =  ' ';
                $productAttrArr['0']['price'] =  ' ';
                $productAttrArr['0']['qty'] =  ' ';
                $productAttrArr['0']['color_id'] = ' ';
                $productAttrArr['0']['size_id'] = ' ';
                $productAttrArr['0']['attr_image'] = ' ';
                $productImgArr['0']['images'] = ' ';
                $productImgArr['0']['id'] = ' ';
                //  echo '<pre>';
                //  print_r($productImgArr);
                //  die();
         $data = compact('url', 'product', 'button', 'categories','sizes', 'colors', 'productAttrArr', 'productImgArr', 'brands', 'taxes');
         return view('admin.manage-product')->with($data);
    }
    public function manage_product_process(Request $req)
    {

        $req->validate(
            ['name' => 'required',
           'slug' => 'required|unique:products',
            'brand' => 'required',
            'model' => 'required',
            'image' => 'required|mimes:png,jpg,jpeg',
            'short_desc' => 'required',
            'desc' => 'required',
            'category_id' => 'required',
            'technical_specifications' => 'required',
            'keywords' => 'required',
            'uses' => 'required',
            'warranty' => 'required',
           // 'attr_image' => 'required|mimes:png,jpeg,jpg'
         ]
        );

       $product = new Product();
       if($req->hasFile('image'))
       {
           $image = $req['image'];
           $ext = $image->extension();
           $image_name = time().'.'.$ext;
           $image->storeAs('/public/media', $image_name);
           $product->image = $image_name;
        }
       $product->name = $req['name'];
       $product->slug = $req['slug'];
       $product->brand = $req['brand'];
       $product->model = $req['model'];
       $product->short_desc = $req['short_desc'];
       $product->desc = $req['desc'];
       $product->category_id = $req['category_id'];
       $product->technical_specifications = $req['technical_specifications'];
       $product->keywords = $req['keywords'];
       $product->uses = $req['uses'];
       $product->warranty = $req['warranty'];
       $product->lead_time = $req['lead_time'];
       $product->tax_id = $req['tax_id'];
       $product->is_promo = $req['is_promo'];
       $product->is_featured = $req['is_featured'];
       $product->is_discounted = $req['is_discounted'];
       $product->is_tranding = $req['is_tranding'];
       $product->status=1;
       $product->save();
       $pid = $product->id;
       //Product attributes

       $paidArr = $req['paid'];
       $pImgArr = $req['pimgid'];
       $skuArr = $req['sku'];
       $mrpArr = $req['mrp'];
       $priceArr = $req['price'];
       $qtyArr = $req['qty'];
       $size_idArr = $req['size_id'];
       $color_idArr = $req['color_id'];
       foreach($skuArr as $key=>$val)
       {
            $productAttrArr['products_id'] = $pid;
            $productAttrArr['sku'] = $skuArr[$key];
            $productAttrArr['mrp'] = $mrpArr[$key];
            $productAttrArr['price'] = $priceArr[$key];
            $productAttrArr['qty'] = $qtyArr[$key];
            if($size_idArr[$key] == NULL)
            {
                $productAttrArr['size_id'] =  0;
            }
            else
            {
                $productAttrArr['size_id'] =  $size_idArr[$key];
            }
            if($color_idArr[$key] == NULL)
            {
                $productAttrArr['color_id'] =  0;
            }
            else
            {
                $productAttrArr['color_id'] =  $color_idArr[$key];
            }
            if($req->hasFile("attr_image.$key"))
            {
             $rand = rand('1111', '9999');
             $attr_image = $req->file("attr_image.$key");
             $ext = $attr_image->extension();
             $image_name = $rand.'.'.$ext;
             $req->file("attr_image.$key")->storeAs('/public/media', $image_name);
             $productAttrArr['attr_image'] = $image_name;
            }
            DB::table('product_attr')->insert($productAttrArr);
       }

            // product images start

            foreach($pImgArr as $key=>$val)
            {
                $productImgArr['products_id'] = $pid;

                if($req->hasFile("images.$key"))
                {
                   $rand = rand('1111', '9999');
                   $images = $req->file("images.$key");
                   $ext = $images->extension();
                   $image_name = $rand.'.'.$ext;
                   $req->file("images.$key")->storeAs('/public/media', $image_name);
                   $productImgArr['images'] = $image_name;

                }
                DB::table('product_images')->insert($productImgArr);
            }

            // end product images

       $req->session()->flash('message', 'Product inserted successfuly ');
       return redirect('admin/product');

    }
    public function delete(Request $req, $id)
     {

        $arrImgP = DB::table('products')->where(['id' => $id])->get();
        $arrImgPI = DB::table('product_attr')->where(['products_id' => $id])->get();
        $arrImgA = DB::table('product_images')->where(['products_id' => $id])->get();
        Storage::delete('/public/media/'.$arrImgP[0]->image);
        foreach($arrImgPI as $pImage)
        {
            Storage::delete('/public/media/'.$pImage->attr_image);
        }
        foreach($arrImgA as $aImage)
        {

            Storage::delete('/public/media/'.$aImage->images);

        }
        DB::table('product_attr')->where(['products_id'=> $id])->delete();
        DB::table('product_images')->where(['products_id'=> $id])->delete();
        DB::table('products')->delete($id);
        return redirect('admin/product');
     }
     public function edit($id)
     {
         $product = Product::find($id);
         if(is_null($product))
         {
             return redirect('admin/product');
         }
         else{
             $url = url('admin/manage-product/update')."/". $id;
             $button = "Update";
             $categories = DB::table('categories')->where(['status'=>1])->get();
             $sizes = DB::table('sizes')->where(['status'=>1])->get();
             $colors = DB::table('colors')->where(['status'=>1])->get();
             $productAttrArr = DB::table('product_attr')->where(['products_id'=>$id])->get();
             $productImgArr = DB::table('product_images')->where(['products_id'=>$id])->get();
             $brands = DB::table('brands')->where(['status'=>1])->get();
             $taxes = DB::table('taxes')->where(['status'=>1])->get();
            //  echo '<pre>';
            //  print_r($products_attr);
            //  die();
             $data = compact('product', 'url', 'button', 'categories',
             'sizes', 'colors', 'productAttrArr', 'productImgArr', 'brands', 'taxes');
             return view('admin.manage-product')->with($data);
         }
     }
     public function update($id, Request $req)
     {
         $req->validate(
           ['name' => 'required',
           'slug' => 'required|unique:products,slug,'.$id,
           'brand' => 'required',
           'model' => 'required',
           'short_desc' => 'required',
           'desc' => 'required',
           'category_id' => 'required',
           'technical_specifications' => 'required',
           'keywords' => 'required',
           'uses' => 'required',
           'warranty' => 'required',
           // 'attr_image' => 'required|mimes:png,jpeg,jpg'
        ]
       );
       $product = Product::find($id);
       if($req->hasFile('image'))
       {
           $arrImg = DB::table('products')->where(['id' => $id])->get();
           Storage::delete('/public/media/'.$arrImg[0]->image);
        //   DB::table('products')->delete($id);
           $image = $req['image'];
           $ext = $image->extension();
           $image_name = time().'.'.$ext;
           $image->storeAs('/public/media', $image_name);
           $product->image = $image_name;

       }

       $product->name = $req['name'];
       $product->slug = $req['slug'];
       $product->brand = $req['brand'];
       $product->model = $req['model'];
       $product->short_desc = $req['short_desc'];
       $product->desc = $req['desc'];
       $product->category_id = $req['category_id'];
       $product->technical_specifications = $req['technical_specifications'];
       $product->keywords = $req['keywords'];
       $product->uses = $req['uses'];
       $product->warranty = $req['warranty'];
       $product->lead_time = $req['lead_time'];
       $product->tax_id = $req['tax_id'];
       $product->is_promo = $req['is_promo'];
       $product->is_featured = $req['is_featured'];
       $product->is_discounted = $req['is_discounted'];
       $product->is_tranding = $req['is_tranding'];
       $product->save();
      // $pid = $product->id;
       //Product attributes


       $paidArr = $req['paid'];
       $pImgArr = $req['pimgid'];
       $skuArr = $req['sku'];
       $mrpArr = $req['mrp'];
       $priceArr = $req['price'];
       $qtyArr =  $req['qty'];
       $size_idArr = $req['size_id'];
       $color_idArr = $req['color_id'];
       foreach($skuArr as $key=>$val)
        {

           $check = DB::table('product_attr')->
           where('sku','=',$skuArr[$key])->
           where('id','!=',$paidArr[$key])->
           get();
           if(isset($check[0]))
           {
              $req->session()->flash('sku_err',$skuArr[$key].' SKU already exist!');
              return redirect(request()->headers->get('referer'));
           }
            $productAttrArr=[];
            $productAttrArr['products_id'] = $id;
            $productAttrArr['sku'] =  $skuArr[$key];
            $productAttrArr['mrp'] =   (int)$mrpArr[$key];
            $productAttrArr['price'] =   (int)$priceArr[$key];
            $productAttrArr['qty'] =   (int)$qtyArr[$key];
            // echo '<pre>';

            //  $productImgArr['images'] =  $imgArr[$key];
            if($size_idArr[$key] == NULL)
            {
                $productAttrArr['size_id'] =  0;
            }
            else
            {
                $productAttrArr['size_id'] =  $size_idArr[$key];
            }
            if($color_idArr[$key] == NULL)
            {
                $productAttrArr['color_id'] =  0;
            }
            else
            {
                $productAttrArr['color_id'] =  $color_idArr[$key];
            }

          if($req->hasFile("attr_image.$key"))
          {
            if($paidArr[$key] != Null)
            {
             $arrImg = DB::table('product_attr')->where(['id' => $paidArr[$key]])->get();
             if(Storage::exists('/public/media/'.$arrImg[0]->attr_image))
             {
                 Storage::delete('/public/media/'.$arrImg[0]->attr_image);
             }
            }
           $rand = rand('11111111', '99999999');
           $attr_image = $req->file("attr_image.$key");
           $ext = $attr_image->extension();
           $image_name = $rand.'.'.$ext;
           $req->file("attr_image.$key")->storeAs('/public/media', $image_name);
           $productAttrArr['attr_image'] = $image_name;
           }
            if($paidArr[$key] != NULL)
            {
                DB::table('product_attr')->where(['id'=>$paidArr[$key]])->update($productAttrArr);
            }
            else
            {
                // echo 'skjdksjdks';
                // die();
                DB::table('product_attr')->insert($productAttrArr);
            }
        }
        // end product attr

        // product images start

            foreach($pImgArr as $key=>$val)
            {
                $productImgArr['products_id'] = $id;

                if($req->hasFile("images.$key"))
                {
                   if($pImgArr[$key] != Null)
                   {
                    $arrImg = DB::table('product_images')->where(['id' => $pImgArr[$key]])->get();
                    if(Storage::exists('/public/media/'.$arrImg[0]->images))
                    {
                        Storage::delete('/public/media/'.$arrImg[0]->images);
                    }
                   }
                   $rand = rand('11111111', '99999999');
                   $images = $req->file("images.$key");
                   $ext = $images->extension();
                   $image_name = $rand.'.'.$ext;
                   $req->file("images.$key")->storeAs('/public/media', $image_name);
                   $productImgArr['images'] = $image_name;
                }
                if($pImgArr[$key] != NULL)
                {
                    DB::table('product_images')->where(['id'=>$pImgArr[$key]])->update($productImgArr);
                }
                else
                {
                    DB::table('product_images')->insert($productImgArr);
                }
            }

            // end product images
       $req->session()->flash('message', 'Product updated successfuly ');
       return redirect('admin/product');
     }
     public function status(Request $req, $status, $id)
     {
        $product = Product::find($id);
        $product->status = $status;
        $product->save();
        $req->session()->flash('message', 'product status updated');
        return redirect('admin/product');
     }
     public function deleteAttr(Request $req, $pid, $id)
     {

        $arrImg = DB::table('product_attr')->where(['id' => $id])->get();
        Storage::delete('/public/media/'.$arrImg[0]->attr_image);
        DB::table('product_attr')->delete($id);
        return redirect('admin/manage-product/edit/'.$pid);

     }
     public function deleteImg(Request $req, $pid, $id)
     {
        $arrImg = DB::table('product_images')->where(['id' => $id])->get();
        Storage::delete('/public/media/'.$arrImg[0]->images);
        DB::table('product_images')->delete($id);
        return redirect('admin/manage-product/edit/'.$pid);

     }
}
