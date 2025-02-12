<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Repositories\CartRepository;
use App\Repositories\ProductRepository;
use Illuminate\Support\Facades\Auth;

class AddToCartModalComponent extends Component
{
    public $product;
    public $quantity = 1;
    public $isOpen = false;
    protected $listeners = ['openAddToCartModal'];
    public $selectedWeight;
    public $selected_variant;
    private $max_quantity = 0;
    private $cartRepository;
    private $productRepository;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->cartRepository = app(CartRepository::class); // Resolve repository instance
        $this->productRepository = app(ProductRepository::class); // Resolve the repository
    }

    public function mount(){
        // if(!empty($this->product->variants)){
            // $this->selectedWeight = $this->product->variants->first()->id ?? null; // Set the first variant as default
            // dd($this->selectedWeight);
        // }
    }

    public function render()
    {    
        return view('livewire.add-to-cart-modal-component')->layout('layouts.app');
    }

    public function openAddToCartModal($product_id)
    {
        $this->product = Product::findOrFail($product_id);
        $this->quantity = 1;
        $this->isOpen = true;
        if(empty($this->selected_variant)){
            if(!empty($this->product->variants)){
                $this->selected_variant = $this->product->variants[0]->id;
            }
        }
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    public function selectedVariant($variant_id)
    {
        $this->selected_variant = $variant_id;
        $max_quantity = $this->productRepository->getQuantity($variant_id);
        if($max_quantity>0){
            $this->max_quantity = $max_quantity;
        }
    }
    
    public function updateQuantity($quantity)
    {
        if($this->selected_variant!=''){
            $this->quantity = (int)$this->quantity + (int)$quantity;
        }
        // dd($this->quantity);
    }
    // public function selectWeight($variant)
    // {
    //     $this->dispatch('selectWeight', ['variant' => $variant]);
    // }

    public function addToCart()
    {
        $user = Auth::user();   
        if(!empty($user)){
            $cart = $this->cartRepository->getOrCreateCart($this->product->id);
            if (!$this->selected_variant) {
                session()->flash('error', 'Please select a variant.');
                return;
            }

            $variant = $this->product->variants->find($this->selected_variant);

            if (!$variant || $variant->is_disabled) {
                session()->flash('error', 'The selected variant is not available.');
                return;
            }

            if ($this->quantity > $variant->stock) {
                session()->flash('error', 'The quantity exceeds available stock.');
                return;
            }
            $price = $variant->price;
            $total = (integer)$this->quantity*(float)$price;
            // Assuming there's a global helper or cart service
            // \Cart::add($variant, $this->quantity);
            $metadata = json_encode($variant);
            $this->cartRepository->addItem($cart, $this->product, $this->quantity, $variant->id, $price , $total, $metadata);
            $this->dispatch('cartUpdated'); // Notify cart icon component
            session()->flash('success', 'Product added to cart successfully.');
        }else{
            session()->flash('error', 'Please Login.');
            // dd(session('message'));
        }
    }
}
