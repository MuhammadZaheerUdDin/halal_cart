<?php

namespace App\Livewire\Admin\Order;

use App\Models\Order;
use App\Repositories\OrderRepository;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class OrderComponent extends Component
{
    protected $listeners = ['updateStatus','cancelOrder'];

    private $orderRepository;
    public $status = null;

    public function __construct()
    {
        $this->orderRepository = app(OrderRepository::class); // Resolve repository instance
    }
    public function render()
    {
        $status = $this->status;
        if(!empty($status)){
            $product_orders = $this->orderRepository->getAll(['status'=> $status]);
        }else{
            $product_orders = $this->orderRepository->getAll();
        }

        return view('livewire.admin.order.order-component',compact('product_orders'))->layout('admin.layouts.app');
    }

    public function updateStatus($product_id)
    {
        // Find the order by ID
        $order = Order::findOrFail($product_id);
    
        // Check if the current status exists in the status flow
        $nextStatus = Order::$statusFlow[$order->status] ?? null;
    
        if ($nextStatus) {
            // If there is a next status in the flow, update the order status
            $order->status = $nextStatus;
            $order->save();
    
            // Set a success message to display
            session()->flash('message', 'Order status updated to ' . $nextStatus);
        } else {
            // If no next status is available, return an error message
            session()->flash('error', 'Cannot update status.');
        }
    }
    
    public function cancelOrder($productId)
    {
        $order = Order::findOrFail($productId);
    
        // Only allow cancellation for certain statuses
        if (in_array($order->status, Order::$cancelableStatuses)) {
            $order->status = 'canceled';
            $order->save();
    
            session()->flash('message', 'Order has been canceled.');
        } else {
            session()->flash('error', 'Order cannot be canceled at this stage.');
        }
    }

    public function markFailedDelivery($productId)
    {
        $order = Order::findOrFail($productId);
    
        if ($order->status === 'shipped') {
            $order->status = 'failed_delivery';
            $order->save();
    
            session()->flash('message', 'Order marked as failed delivery.');
        } else {
            session()->flash('error', 'Failed delivery can only be marked for shipped orders.');
        }
    }
            
}
