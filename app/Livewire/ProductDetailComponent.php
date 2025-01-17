<?php

namespace App\Livewire;

use Livewire\Component;
use App\Repositories\CartRepository;
use App\Repositories\ProductRepository;
use Illuminate\Support\Facades\Auth;

class ProductDetailComponent extends Component
{
    protected $cartRepository;
    protected $productRepository;
    public $product, $quantity = 1, $variant_id, $metadata = [];
    public $selectedVariant = null;
    // public $quantity = 1;

    public function __construct()
    {
        $this->cartRepository = app(CartRepository::class);
        $this->productRepository = app(ProductRepository::class);
    }

    public function mount($slug)
    {
        $this->product = $this->productRepository->findBySlug($slug);
    }

    public function render()
    {
        return view('livewire.product-detail-component')->layout('layouts.app');
    }

    public function selectVariant($variantId)
    {
        $this->selectedVariant = $variantId;
        // dd($this->selectedVariant);
    }    

    public function incrementQuantity()
    {
        $this->quantity++;
    }

    public function decrementQuantity()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
        }
    }

    public function addToCart()
    {
        $user = Auth::user();   
        $cart = $this->cartRepository->getOrCreateCart($this->product->id);
        // $variant = $this->product->variants->where('id', $variant_id)->select(['id','product_id','variant_name','variant_value'])->first();
        // $this->metadata = json_encode($variant);
        // $this->cartRepository->addItem($cart, $this->product, $this->quantity, $variant_id, $this->metadata);
        // return response()->json(['message' => 'Item added to cart successfully!']);

        if (!$this->selectedVariant) {
            session()->flash('error', 'Please select a variant.');
            return;
        }

        $variant = $this->product->variants->find($this->selectedVariant);

        if (!$variant || $variant->is_disabled) {
            session()->flash('error', 'The selected variant is not available.');
            return;
        }

        if ($this->quantity > $variant->stock) {
            session()->flash('error', 'The quantity exceeds available stock.');
            return;
        }

        // Assuming there's a global helper or cart service
        // \Cart::add($variant, $this->quantity);
        $this->metadata = json_encode($variant);
        $total = $variant->price * $this->quantity;
        $this->cartRepository->addItem($cart, $this->product, $this->quantity, $variant->id, $variant->price , $total, $this->metadata);

        session()->flash('message', 'Product added to cart successfully.');
    }

}
