<?php
namespace App\Repositories;

use App\Models\Order;
use App\Models\OrderProduct;
use Exception;

class OrderRepository
{
    /**
     * Fetch all products with optional filters.
     */
    public function getAll($filters = [])
    {
        $query = Order::query();

        if (!empty($filters['category_id'])) {
            $query->where('category_id', $filters['category_id']);
        }
        if (!empty($filters['subcategory_id'])) {
            $query->where('subcategory_id', $filters['subcategory_id']);
        }

        if (!empty($filters['search'])) {
            $query->where('name', 'like', '%' . $filters['search'] . '%');
        }

        return $query->get();
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
