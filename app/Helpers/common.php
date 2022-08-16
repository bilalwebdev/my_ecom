<?php

use Illuminate\Support\Facades\DB;
use App\Models\ShoppingCart;
use App\Models\Admin\Coupon;
function getTopNav()
{

    $home_categories=DB::table('categories')
    ->where(['status'=>1])
     ->get();
    $arr=[];
    foreach($home_categories as $row)
    {
    $arr[$row->id]['category']= $row->category_name;
    $arr[$row->id]['parent_category']= $row->parent_category_id;
    $arr[$row->id]['category_slug']= $row->category_slug;
    }
    $str = buildTreeView($arr,0);
    return $str;

}

function getCartItems()
{
    if(session()->has('FRONT_USER_LOGIN'))
        {
           $user_id = session()->get('FRONT_USER_ID');
            $user_type = "Reg";
        }
        else{
            $user_id = getUserTempId();
            $user_type = "Non-Reg";
        }

        $items = DB::table('shopping_carts')
        ->leftJoin('products', 'products.id', '=', 'shopping_carts.product_id')
        ->leftJoin('product_attr', 'product_attr.id', '=', 'shopping_carts.product_attr_id')
        ->leftjoin('sizes', 'sizes.id', '=' , 'product_attr.size_id')
        ->leftjoin('colors', 'colors.id', '=' , 'product_attr.color_id')
        ->where(['user_id' => $user_id])
        ->where(['user_type' => $user_type])
        ->select('shopping_carts.qty', 'products.name', 'products.image', 'products.slug',
         'sizes.size', 'colors.color', 'product_attr.price', 'products.id as pid', 'product_attr.id as attr_id')
        ->get();

       return $items;
}



$html='';
function buildTreeView($arr, $parent, $level=0, $prelevel=-1){
    global $count;
      global $html;
      foreach($arr as $id=>$data)
      {
          if($parent==$data['parent_category'])
          {

              if($level>$prelevel)
              {
                  if($html=='')
                  {
                    $html.='<ul class="nav navbar-nav">';
                    $a=1;
                  }
                  else
                  {
                    $html.='<ul class="dropdown-menu">';
                  }
              }
              if($level==$prelevel)
              {
               // echo "123</br>";
              // $html.='1';
                  $html.='</li>';
              }
              $url=url("/category/".$data['category_slug']);
              $html.='<li><a href= "'.$url.'">'.$data['category'].'<span class="caret"></span></a>';

              if($level>$prelevel)
              {
                  $prelevel=$level;
              }
             $level++;
             buildTreeView($arr, $id, $level, $prelevel);
             $level--;
             //echo $level;
          }
         // die();
         // echo" cjjcvhjcv</n>";
      }
      if($level==$prelevel){
          $html.='</li></ul>';
      }
      return $html;
  }
  function getUserTempId()
  {
     if(!session()->has('USER_TEMP_ID'))
     {
         $rand = rand(111111, 999999);
         session()->put('USER_TEMP_ID', $rand);
         return $rand;
     }
     else{
        return session()->get('USER_TEMP_ID');
     }
  }
  function applyCouponCode($coupon_code)
  {
   //dd($_POST);
   $total_price = 0;
   $coupon_code_value=0;
   $cart_items = getCartItems();
   foreach($cart_items as $item)
   {
      $total_price+=($item->qty*$item->price);
   }
   $coupon_code = Coupon::where('code', $coupon_code)->get();
  if(isset($coupon_code[0]))
  {
      if($coupon_code[0]->status==1)
      {
          $type = $coupon_code[0]->type;
          $value = $coupon_code[0]->value;
          if($coupon_code[0]->is_one_time==1)
          {
           $status = "error";
           $msg = "Coupon code already used!";
          }
          else
          {
              $min_order_amt = $coupon_code[0]->min_order_amt;
              if($min_order_amt>0)
              {
               if($total_price>$min_order_amt)
               {
                   $status = "success";
                   $msg = "Coupon code applied!";
               }
               else
               {
                   $status = "error";
                   $msg = "Cart amount must me greater than Rs $min_order_amt";
               }
              }
              else
              {
               $status = "success";
               $msg = "Coupon code applied!";
              }

          }
      }
      else{
       $status = "error";
       $msg = "Coupon code deactivated!";
      }
  }
  else
  {
   $status = "error";
   $msg = "Please enter valid coupon code!";
  }

  if($status == 'success')
  {

      if($type == 'Value')
      {
          $total_price-=$value;
          $coupon_code_value=$value;
      }
      else{
          $per = ($value/100)*$total_price;
          $total_price-=round($per);
          $coupon_code_value=$per;
      }
  }
  return json_encode(["msg" => $msg, "status" => $status, "total_price" => $total_price, "coupon_code_value" => $coupon_code_value]);
}

function getAvailableQty($pid, $attr_id)
{

    $qty = DB::table('order_details')
        ->leftJoin('orders', 'orders.id', '=', 'order_details.order_id')
        ->leftJoin('product_attr', 'product_attr.id', '=', 'order_details.product_attr_id')
        ->where('order_details.product_id', $pid)
        ->where('order_details.product_attr_id', $attr_id)
        ->select('order_details.qty', 'product_attr.qty as pqty')
        ->get();
   ///////dd($qty);
        return $qty;

}
