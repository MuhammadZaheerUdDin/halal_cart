<?php

namespace App\Livewire;

use App\Models\SubCategory;
use Closure;
// use Illuminate\Contracts\View\View;
use Livewire\Component;
use App\Repositories\CartRepository;
use App\Repositories\ProductRepository;
use Exception;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Route;

// use Illuminate\View\Component;

class ProductCategoriesComponent extends Component
{
    public $all_products, $products;
    protected $productRepository;
    protected $cartRepository;
    public $sub_category;
    public $page;
    public $visibleProducts = [];
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->cartRepository = app(CartRepository::class); // Resolve repository instance
        $this->productRepository = app(ProductRepository::class); // Resolve the repository
    }

    public function mount($encrypted)
    {
        $this->page = Route::current()->parameter('encrypted'); // Get route parameter

        // if ($category && str_contains(strtolower($category), 'boxed')) {
        //     $this->page = 'boxed';
        //     $url = 'livewire.user.product-categories-component';
        //     $url = 'livewire.user.product-box-categories-component';
        // }else{
        //     $this->page = null;
        // }
        if(!empty($encrypted)){
            try{
                $category = Crypt::decrypt($encrypted);
                $this->sub_category = SubCategory::where('slug',$category)->first();
                $this->products = $this->productRepository->getAll(['subcategory_id' => !empty($this->sub_category)?$this->sub_category->id:'#']); // Fetch all products
            }catch(Exception $e){
                $this->sub_category = null;
            }
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render() //: View|Closure|string
    {
        // dd($this->page);
        // dd($this->sub_category);
        // dd($this->products);
        try{
            $category = Crypt::decrypt($this->page);
            // dd($category);
            if (!empty($category) && str_contains(strtolower($category), 'boxed')) {
                // dd($products);
                return view('livewire.user.product-box-categories-component')->layout('layouts.app');
            }else{
                // dd($this->page);
                return view('livewire.user.product-categories-component')->layout('layouts.app');
            }
        }catch(Exception $e){
            return view('livewire.user.product-categories-component')->layout('layouts.app');
        }
    }

    public function toggleVisibility($productId)
    {
        if (isset($this->visibleProducts[$productId]) && $this->visibleProducts[$productId]) {
            $this->visibleProducts[$productId] = false;
        } else {
            $this->visibleProducts[$productId] = true;
        }
    }
    

}
