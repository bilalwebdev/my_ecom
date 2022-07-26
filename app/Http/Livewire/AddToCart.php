<?php

namespace App\Http\Livewire;

use App\Models\ShoppingCart;
use Livewire\Component;

class AddToCart extends Component
{
    public $product_id;
    public $product_attr_id;
    public $qty;

    public function addToCart()
    {
        ShoppingCart::create(
            [
                'user_id' => 1,
                'product_id' => $this->product_id,
                'added on' => now(),
                'qty' => $this->qty,
                'product_attr_id' => $this->product_id
            ]
            );
    }
    public function render()
    {
        //dd($this->product_attr_id);

        return view('livewire.add-to-cart');
    }

}
