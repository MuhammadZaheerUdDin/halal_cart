<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;
    
    protected $fillable = ['name', 'description', 'price', 'stock', 'sku', 'image', 'category_id','subcategory_id'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            $product->slug = Str::slug($product->name);

            // Ensure uniqueness if needed
            $count = static::where('slug', 'LIKE', "{$product->slug}%")->count();
            if ($count > 0) {
                $product->slug .= '-' . ($count + 1);
            }
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class)->withPivot('quantity');
    }

    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class);
    }
    
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
    
    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }
    public function latestVariant()
    {
        return $this->hasOne(ProductVariant::class)->latest();
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function averageRating()
    {
        return $this->ratings()->avg('rating');
    }
}