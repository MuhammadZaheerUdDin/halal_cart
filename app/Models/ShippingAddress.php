<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingAddress extends Model
{
    /** @use HasFactory<\Database\Factories\ShippingAddressFactory> */
    use HasFactory;
    
    protected $fillable = ['user_id' , 'first_name' , 'last_name' ,'email' ,'phone_number' ,'address1', 'address2','country', 'city', 'state', 'postal_code', 'country'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
