<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;
    protected $fillable = ['user_id', 'total', 'status', 'first_name' , 'last_name' ,'email' ,'phone_number' ,'address1', 'address2','country', 'city', 'state', 'postal_code', 'country','is_paid'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity');
    }
    
    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

}
