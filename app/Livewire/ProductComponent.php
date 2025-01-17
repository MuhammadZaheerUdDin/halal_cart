<?php

namespace App\Livewire;

use App\Models\Product;
use App\Repositories\CartRepository;
use App\Repositories\ProductRepository;
use Livewire\Component;

class ProductComponent extends Component
{
    public $product;
    protected $productRepository;
    protected $cartRepository;

    public function __construct()
    {
        $this->cartRepository = app(CartRepository::class);
        $this->productRepository = app(ProductRepository::class);
    }

    // public function mount($slug)
    // {
    //     $this->product = $this->productRepository->findBySlug($slug);
    // }

    public function render()
    {
        $products = Product::all();
        return view('livewire.user.product-component',compact('products'))->layout('layouts.app');
    }
}
