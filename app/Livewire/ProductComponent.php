<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class ProductComponent extends Component
{
    public function render()
    {
        $products = Product::all();
        return view('livewire.product-component',compact('products'))->layout('layouts.app');
    }
}
