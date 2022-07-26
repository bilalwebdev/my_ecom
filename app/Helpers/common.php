<?php

use Illuminate\Support\Facades\DB;
use App\Models\ShoppingCart;
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
    }
    $str = buildTreeView($arr,0);
    return $str;

}

function getCartItems()
{
    if(session()->has('FRONT_USER_LOGIN'))
        {
           $user_id = session()->get('FRONT_USER_LOGIN');
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
              $html.=' <li><a href="#">'.$data['category'].'<span class="caret"></span></a>';

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
     if(session()->has('USER_TEMP_ID') === null)
     {
         $rand = rand(111111, 999999);
         session()->put('USER_TEMP_ID', $rand);
         return $rand;
     }
     else{
        return session()->has('USER_TEMP_ID');
     }
  }
