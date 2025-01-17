<?php

namespace App\Livewire\User;

use App\Models\Product;
use App\Models\SubCategory;
use App\Repositories\CartRepository;
use App\Repositories\ProductRepository;
use Livewire\Component;

class HomeComponent extends Component
{
    //public $products;
    public $all_products;
    protected $productRepository;
    protected $cartRepository;

    public function mount(){
        $this->cartRepository = app(CartRepository::class); // Resolve repository instance
        $this->productRepository = app(ProductRepository::class); // Resolve the repository
    }

    public function render()
    {
        $products = $this->productRepository->getAll(); // Fetch all products
        return view('livewire.index',compact('products'))->layout('layouts.app');    }
        // return view('livewire.user.home-component',compact('products'))->layout('layouts.app');    }

    }
