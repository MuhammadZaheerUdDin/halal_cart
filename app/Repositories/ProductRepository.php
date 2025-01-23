<?php
namespace App\Repositories;

use App\Models\Product;
use App\Models\ProductVariant;

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
     * Update a product by ID.
     */
    public function updateOrderQuantity($product_id , $variant_id, $quantity)
    {
        $product = Product::findOrFail($product_id);
        if($product)
        {
            $product->stock =- $quantity;
            $p = $product->save();
            if(!empty($p))
            {
                $product_variant = ProductVariant::where('id', $variant_id)
                ->where('product_id', $product_id)
                ->firstOrFail();
                if ($product_variant->stock >= $quantity) {
                    $product_variant->stock -= $quantity;
                    $p_v = $product_variant->save();
                    if($p_v){
                        return true;
                    }
                }
            }
        }
        return false;
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

    public function getQuantity($variant_id){
        $variant = ProductVariant::find($variant_id);

        if ($variant) {
            return $variant->quantity; // Assuming 'stock' represents available quantity
        } else {
            return 0;
            //$this->maxQuantity = 0; // No stock if variant not found
        }
    }

    public function getRandomProducts($limit = 6)
    {
        // return Product::inRandomOrder()->limit($limit)->get();
        $randomIds = Product::select('id')
        ->inRandomOrder()
        ->limit(6)
        ->pluck('id');
        return Product::whereIn('id', $randomIds)->get();        
    }

}
