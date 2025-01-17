<?php
namespace App\Repositories;

use App\Models\ShippingAddress;
use Exception;
use Illuminate\Support\Facades\Auth;

class AddressRepository
{
    public function getAll($filters = [])
    {
        $query = ShippingAddress::query();

        if (!empty($filters['user_id'])) {
            $query->where('user_id', $filters['user_id']);
        }
        // if (!empty($filters['subcategory_id'])) {
        //     $query->where('subcategory_id', $filters['subcategory_id']);
        // }

        // if (!empty($filters['search'])) {
        //     $query->where('name', 'like', '%' . $filters['search'] . '%');
        // }

        return $query->get();
    }

    public function findById($user_id)
    {
        return ShippingAddress::where('user_id',$user_id)->first();
    }

    public function create(array $data)
    {
        $address = '';
        try{
            if(!empty($data)){
                $address = ShippingAddress::updateOrCreate($data);
            }
        }catch(Exception $e){
            $address = null;
        }
        return $address;
    }

    /**
     * Update a product by ID.
     */
    public function update($id, array $data)
    {
        $address = ShippingAddress::findOrFail($id);
        try{
            if(!empty($data)){
                $address->update($data);
            }
            return $address;
        }catch(Exception $e){
            $address = null;
        }
        return null;
    }

    /**
     * Delete a address by ID.
     */
    public function delete($id)
    {
        $address = ShippingAddress::findOrFail($id);
        $address->delete();

        return true;
    }

}