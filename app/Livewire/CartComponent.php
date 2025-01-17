<?php

namespace App\Livewire;

use App\Repositories\CartRepository;
use App\Repositories\ProductRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CartComponent extends Component
{
    protected $productRepository;
    protected $cartRepository;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->cartRepository = app(CartRepository::class);
        $this->productRepository = app(ProductRepository::class);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()//: View|Closure|string
    {
        if(!empty(Auth::user())){
            // $cart = $this->cartRepository->getOrCreateCart($this->product->id);
            $cart = $this->cartRepository->getcartItems();//$cart->items()->with('itemable')->get() : [];
            // dd($cart);
        }else{
            $cart=null;
        }
        // dd('za');
        return view('livewire.user.cart-component',compact('cart'))->layout('layouts.app');
    }
}
