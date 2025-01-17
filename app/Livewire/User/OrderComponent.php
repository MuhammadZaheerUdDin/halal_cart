<?php

namespace App\Livewire\User;

use App\Models\Order;
use App\Models\OrderProduct;
use Livewire\Component;

class OrderComponent extends Component
{
    public function render()
    {
        $product_orders = OrderProduct::all();
        return view('livewire.user.order-component',compact('product_orders'))->layout('layouts.app');
    }
}
