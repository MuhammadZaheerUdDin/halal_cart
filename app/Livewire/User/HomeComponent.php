<?php

namespace App\Livewire\User;

use App\Models\Product;
use App\Models\SubCategory;
use App\Repositories\CartRepository;
use App\Repositories\ProductRepository;
use Illuminate\Support\Facades\Cache;
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
        $header_menu_items = Cache::remember('header_menu_items', 60 * 60, function () {
            // Replace with your query to fetch dynamic menu items
            return SubCategory::select('name','slug','image')->where('status', 1)
                ->orderBy('position', 'asc')
                ->get()
                ->toArray();
        });

        // $headerMenuItems = Cache::get('header_menu_items', []);
        $headerMenuCount = count($header_menu_items);
        // Repeat items to make it at least 9
        while ($headerMenuCount < 9) {
            $header_menu_items = array_merge($header_menu_items, $header_menu_items);
            $headerMenuCount = count($header_menu_items);
        }
    
        // Limit to exactly 9 items
        $header_menu_items = array_slice($header_menu_items, 0, 9);


        $products = $this->productRepository->getRandomProducts(6);
        // dd($products);
        $products = $products->chunk(3);
        return view('livewire.index',compact('products','header_menu_items'))->layout('layouts.app');    
    }
    // return view('livewire.user.home-component',compact('products'))->layout('layouts.app');    }

}
