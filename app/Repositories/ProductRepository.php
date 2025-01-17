<?php
namespace App\Repositories;

use App\Models\Product;

class ProductRepository
{
    /**
     * Fetch all products with optional filters.
     */
    public function getAll($filters = [])
    {
        $query = Product::query();

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
     * Fetch a single product by ID.
     */
    public function findById($id)
    {
        return Product::findOrFail($id);
    }

    /**
     * Fetch a single product by ID.
     */
    public function findBySlug($slug)
    {
        return Product::with('variants')->where('slug', $slug)->firstOrFail();
        // return Product::findOrFail($slug);
    }

    /**
     * Create a new product.
     */
    public function create(array $data)
    {
        return Product::create($data);
    }

    /**
     * Update a product by ID.
     */
    public function update($id, array $data)
    {
        $product = Product::findOrFail($id);
        $product->update($data);

        return $product;
    }

    /**
     * Delete a product by ID.
     */
    public function delete($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return true;
    }
}
