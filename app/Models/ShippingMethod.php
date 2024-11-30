<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingMethod extends Model
{
    /** @use HasFactory<\Database\Factories\ShippingMethodFactory> */
    use HasFactory;
    
    protected $fillable = ['method_name', 'price', 'delivery_time'];
}
