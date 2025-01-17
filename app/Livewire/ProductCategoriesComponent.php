<?php

namespace App\Livewire;

use App\Models\SubCategory;
use Closure;
// use Illuminate\Contracts\View\View;
use Livewire\Component;
use App\Repositories\CartRepository;
use App\Repositories\ProductRepository;
use Illuminate\Support\Facades\Crypt;

// use Illuminate\View\Component;

class ProductCategoriesComponent extends Component
{
    public $all_products;
    protected $productRepository;
    protected $cartRepository;
    public $sub_category;

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
        $category = Crypt::decrypt($encrypted);

        $this->sub_category = SubCategory::where('slug',$category)->first();
    }
    /**
     * Get the view / contents that represent the component.
     */
    public function render() //: View|Closure|string
    {
        $products = $this->productRepository->getAll(['sub_category_id'=>$this->sub_category->id]); // Fetch all products
        return view('livewire.user.product-categories-component',compact('products'))->layout('layouts.app');
    }
    

}
