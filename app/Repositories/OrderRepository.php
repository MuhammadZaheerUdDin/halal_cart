<?php
namespace App\Repositories;

use App\Models\Order;
use App\Models\OrderProduct;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;

class OrderRepository
{
    /**
     * Fetch all products with optional filters.
     */
    public function getAll($filters = [])
    {
        // dd($filters['status']);
        $query = Order::query();
        if(!empty(Auth::user()->id)){
            if(!empty(Auth::user()->user_role) && (Auth::user()->user_role == "super_admin")){

            }else{
                $query->where('user_id', Auth::user()->id);
            }
        }

        if (!empty($filters['category_id'])) {
            $query->where('category_id', $filters['category_id']);
        }
        if (!empty($filters['subcategory_id'])) {
            $query->where('subcategory_id', $filters['subcategory_id']);
        }
        if (!empty($filters['name'])) {
            $query->where('name', 'like', '%' . $filters['name'] . '%');
        }
        if (!empty($filters['status'])) {
            $query->where('status', 'like', '%' . $filters['status'] . '%');
        }
            // dd($filters);
        if(empty(Auth::user()->user_role)){
            if (!empty($filters['start_date']) && !empty($filters['end_date'])) {
                $query->whereBetween('created_at', [$filters['start_date'], $filters['end_date']]);
                // dd($filters);
            }else{
                $end_date = Carbon::today(); // 2025-01-16 2025-02-12 
                // Get last month same day
                $start_date = Carbon::tomorrow()->subMonth(); // 2024-12-16 2025-01-12
                $query->whereBetween('created_at', [$start_date, $end_date]);            
            }
        }
        // dd($query->get());
        return $query->with('orderProducts')->orderBy('created_at', 'desc')->get();
    }

    /**
     * Fetch a single Order by ID.
     */
    public function findById($id)
    {
        return Order::findOrFail($id);
    }

    /**
     * Fetch a single Order by ID.
     */
    public function findBySlug($slug)
    {
        return Order::with('variants')->where('slug', $slug)->firstOrFail();
        // return Order::findOrFail($slug);
    }

    /**
     * Create a new Order.
     */
    public function create(array $data)
    {
        return Order::create($data);
    }

    public function addItems(array $orderItems)
    {
        try {
            OrderProduct::insert($orderItems);
            return true;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Update a Order by ID.
     */
    public function update($id, array $data)
    {
        $order = Order::findOrFail($id);
        $order->update($data);

        return $order;
    }

    /**
     * Delete a Order by ID.
     */
    public function delete($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return true;
    }
}
