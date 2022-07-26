<?php

namespace App\Models\Admin;

use App\Models\ShoppingCart;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    use HasFactory;



    public function carts()
    {
        return $this->hasMany(ShoppingCart::class);
    }

}
