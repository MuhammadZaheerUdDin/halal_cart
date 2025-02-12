<?php

namespace App\Livewire;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CartIcon extends Component
{
    // public function render()
    // {
    //     return view('livewire.cart-icon');
    // }
    protected $listeners = ['cartUpdated' => 'updateCartCount'];

    public $cart_count;

    public function mount()
    {
        $this->cart_count = Cart::count(); // Initialize cart count
    }

    public function updateCartCount()
    {
        $this->cart_count = Cart::count(); // Update when event is fired
    }

    public function render()
    {
        if(!empty(Auth::user())){
            $this->cart_count = CartItem::whereHas('cart', function ($query) {
                $query->where('user_id', Auth::id());
            })->sum('quantity');
        }
        else{
            $this->cart_count = 0;            
        }
        return view('livewire.cart-icon');
    }

}
