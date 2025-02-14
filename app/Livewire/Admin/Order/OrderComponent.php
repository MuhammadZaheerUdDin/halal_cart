<?php

namespace App\Livewire\Admin\Order;

use App\Models\Order;
use App\Repositories\OrderRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Ptondereau\LaravelUpsApi\Facades\UpsTracking;
use Ptondereau\LaravelUpsApi\UpsApiServiceProvider;
use Stripe;
use Stripe\Refund;

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
        if($this->status == 'paid' || $status == 'processing' || $this->status == 'shipped' || $this->status == 'review' || $this->status == 'completed' || $this->status == 'cancelled'){
            // $product_orders = $this->orderRepository->getAll(['status'=> $status]);
            $status = $this->status;
        }else{
            $status = null;
        }

        if(!empty($status)){
            $product_orders = $this->orderRepository->getAll(['status'=> $status]);
        }else{
            $product_orders = $this->orderRepository->getAll();
        }

        return view('livewire.admin.order.order-component',compact('product_orders'))->layout('admin.layouts.app');
    }

    public function showTab($status){
        if($status == 'paid' || $status == 'processing' || $status == 'shipped' || $status == 'review' || $status == 'completed' || $status == 'cancelled'){
            $this->status = $status;
        }else{
            $this->status = 'all';
            // $product_orders = $this->orderRepository->getAll();
        }
    }

    public function updateStatus($product_id)
    {
        // $ups = new UpsTracking();
        // dd($ups->track('123'));
        // $ups->
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
    
    public function cancelOrder($product_id)
    {
        $order = Order::findOrFail($product_id);
        DB::beginTransaction();
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));    
        // Only allow cancellation for certain statuses
        if (in_array($order->status, Order::$cancelableStatuses)) {
            $order->status = 'cancelled';
            $order->save();            
            // $refund = Stripe\Refund::create([
            //     'charge' => $order->transaction_id, // ID of the Stripe patment
            //     // 'amount' => 1000, // Amount in cents (optional, for partial refunds)
            // ]);    
            DB::commit();
            session()->flash('message', 'Order has been canceled.');
        } else {
            DB::rollBack();
            session()->flash('error', 'Order cannot be canceled at this stage.');
        }
        DB::rollBack();
    }

    public function markFailedDelivery($product_id)
    {
        $order = Order::findOrFail($product_id);
    
        if ($order->status === 'shipped') {
            $order->status = 'failed_delivery';
            $order->save();
    
            session()->flash('message', 'Order marked as failed delivery.');
        } else {
            session()->flash('error', 'Failed delivery can only be marked for shipped orders.');
        }
    }
            
}
