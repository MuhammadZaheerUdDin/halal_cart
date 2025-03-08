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
use Livewire\WithPagination;

// use Illuminate\View\Component;

class ProductCategoriesComponent extends Component
{
    use WithPagination;

    public $perPage = 1; // Initial number of products

    protected $paginationTheme = 'bootstrap'; // Optional: To use Bootstrap styling
    public $currentPage , $lastPage;
    public $all_products, $products, $products_items;
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
                // $this->products = //$this->productRepository->getAll(['subcategory_id' => !empty($this->sub_category)?$this->sub_category->id:'#']); // Fetch all products
                $this->loadProducts();
            }catch(Exception $e){
                dd($e);
                $this->sub_category = null;
            }
        }
    }
    public function loadProducts()
    {
        $products = $this->productRepository->getAll([
            'subcategory_id' => !empty($this->sub_category) ? $this->sub_category->id : '#',
            'perPage' => $this->perPage

        ]);//->take($this->perPage); // Initially load limited products
        // dd($products);
        $this->products = $products->items(); // Extract data from paginator
        $this->lastPage = $products->lastPage();
        $this->currentPage = $products->currentPage();
        // dd($this->products);

    }
    public function loadMore()
    {
        $this->perPage += 1; // Increase the number of products displayed
        $this->loadProducts(); // Refresh product list
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
            // $products = $this->productRepository->getAll([
            //     'subcategory_id' => $this->sub_category->id ?? null,
            //     'perPage' => $this->perPage
            // ]);
            // dd($products);
            $category = Crypt::decrypt($this->page);
            // dd($category);
            if (!empty($category) && str_contains(strtolower($category), 'boxed')) {

                return view('livewire.user.product-box-categories-component',['products' => $this->products])->layout('layouts.app');
            }else{
                // dd($this->page);
                return view('livewire.user.product-categories-component')->layout('layouts.app');
                // return view('livewire.user.product-categories-component',['products'=>$products])->layout('layouts.app');
                // return view('livewire.user.product-categories-component',['products' => $this->products])->layout('layouts.app');
                // return view('livewire.user.product-categories-component',compact('products'))->layout('layouts.app');
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
