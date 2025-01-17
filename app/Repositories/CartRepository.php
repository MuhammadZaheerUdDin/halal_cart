<?php
namespace App\Repositories;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;

// use Binafy\LaravelCart\LaravelCart as Cart;

// use Binafy\LaravelCart\Cartable;
// use \Binafy\LaravelCart\Models\Cart;
// use Binafy\LaravelCart\Models\CartItem;

class CartRepository
{
    /**
     * Get the current user's cart or create a new one.
     */
    public function __construct()     
    {
        
    }
    public function getOrCreateCart($user_id)
    {
        return Cart::query()->firstOrCreate(['user_id' => $user_id]);
    }

    /**
     * Add an item to the cart.
     */
    public function addItem($cart, $product, $quantity = 1, $variant_id ,$price , $total, $variant_metadata)
    {

        $cart_item = 
        new CartItem(
            [
            'cart_id' => $cart->id,
            'itemable_id' => $product->id,
            'itemable_type' => get_class($product),
            'quantity' => $quantity,
            'variant_id' => $variant_id,
            'price' => $price,
            'total' => $total,
            'variant_metadata' => $variant_metadata,
            ]
        );
        //  $c = new  Cart();    //  $c->storeItems($cart_item);    // dd($cart_item);    // dd($cart_item);
        Cart::firstOrCreateWithStoreItems($product, $variant_metadata, $variant_id, $quantity,$price,$total);
        // return $cart->items()->save($cart_item);
        //$cart->storeItem($cart_item);
    }

    /**
     * Remove an item from the cart.
     */
    public function removeItem($cart, $itemId)
    {
        return $cart->items()->where('id', $itemId)->delete();
    }

    /**
     * Clear all items from the cart.
     */
    public function clearCart($cart)
    {
        return $cart->items()->delete();
    }

    public function calculatedPriceByQuantity($cart): int
    {
        $totalPrice = 0;
        foreach ($cart->items()->get() as $item) {
            $totalPrice += (int) $item->quantity * (int) $item->itemable->getPrice();
        }

        return $totalPrice;
    }

    public function getcartItems(){
        $user = Auth::user();
        $cart = $user->cart;

        return $cart ? $cart->items()->with('itemable')->get() : [];
    }

}
