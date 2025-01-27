<?php

namespace App\Livewire\User;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Repositories\OrderRepository;
use Livewire\Component;

class OrderComponent extends Component
{
    private $orderRepository;
    public $status = 'all';

    public function __construct()
    {
        $this->orderRepository = app(OrderRepository::class); // Resolve repository instance
    }
    
    public function render()
    {
        // $product_orders = OrderProduct::all();
        // $product_orders = $this->orderRepository->getAll();
        $status = $this->status;
        if($this->status == 'paid' || $status == 'processing' || $this->status == 'shipped' || $this->status == 'review' || $this->status == 'completed'){
            // if($status == 'paid' || $status =='pending'){
            //     $status = 'paid';
            // }
            $product_orders = $this->orderRepository->getAll(['status'=> $status]);
        }else{
            $product_orders = $this->orderRepository->getAll();
        }

        return view('livewire.user.order-component',compact('product_orders'))->layout('layouts.app');
    }

    public function showTab($status){
        if($status == 'paid' || $status == 'processing' || $status == 'shipped' || $status == 'review' || $status == 'completed'){
            $this->status = $status;
        }else{
            $this->status = 'all';
            // $product_orders = $this->orderRepository->getAll();
        }
    }
}
