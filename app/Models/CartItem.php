<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    /** @use HasFactory<\Database\Factories\CartItemFactory> */
    use HasFactory;

    protected $fillable = ['cart_id', 'itemable_type', 'itemable_id' , 'variant_id', 'quantity', 'variation_id', 'variant_metadata', 'price', 'total'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // public function product()
    // {
    //     return $this->belongsTo(Product::class);
    // }

    /**
     * Relation polymorphic, inverse one-to-one or many relationship.
     */
    public function itemable(): \Illuminate\Database\Eloquent\Relations\MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Relation one-to-many, Cart model.
     */
    public function cart(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Cart::class, 'cart_id');
    }
    public function product()//: \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Product::class, 'itemable_id');
    }
    public function variant()//: \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(ProductVariant::class, 'variant_id');
    }


}
