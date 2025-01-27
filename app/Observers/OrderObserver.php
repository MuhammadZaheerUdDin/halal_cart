<?php

namespace App\Observers;

use App\Models\Order;

class OrderObserver
{
    /**
     * Handle the Order "created" event.
     */
    // public function created(Order $order): void
    // {
    //     //
    // }
    public function creating(Order $order)
    {
        $latestOrder = Order::latest('id')->first();
        $nextOrderId = $latestOrder ? $latestOrder->id + 1 : 1;
        $order->order_number = 'ORD-' . str_pad($nextOrderId, 4, '0', STR_PAD_LEFT);
    }
    /**
     * Handle the Order "updated" event.
     */
    public function updated(Order $order): void
    {
        //
    }

    /**
     * Handle the Order "deleted" event.
     */
    public function deleted(Order $order): void
    {
        //
    }

    /**
     * Handle the Order "restored" event.
     */
    public function restored(Order $order): void
    {
        //
    }

    /**
     * Handle the Order "force deleted" event.
     */
    public function forceDeleted(Order $order): void
    {
        //
    }
}
