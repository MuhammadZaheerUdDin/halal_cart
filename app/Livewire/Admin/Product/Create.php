<?php

namespace App\Livewire\Admin\Product;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductVariant;
use App\Models\SubCategory;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $products, $variants = [], $images = [], $previewImages = [];
    public $name, $description, $price, $stock, $sku, $category_id, $subcategory_id, $is_disabled, $image, $productId, $categories, $subcategories;
    
    public $variant_name
    ,$variant_value
    ,$variant_price
    ,$variant_stock;

    public $isEditing = false;

    // protected $rules = [
    //     'name' => 'required|string|max:255',
    //     'description' => 'nullable|string',
    //     'price' => 'nullable|numeric|regex:/^\d+(\.\d{1,2})?$/', // Validate decimal with max 2 digits after decimal
    //     // 'price' => 'required|numeric|min:0',
    //     'stock' => 'required|integer|min:0',
    //     // 'sku' => 'required|string|max:255|unique:products,sku',
    //     'sku' => 'required|string|max:100|unique:products,sku' . ($this->productId ? ",$this->productId" : ''),
    //     'category_id' => 'required|exists:categories,id',
    //     'image' => 'nullable|image|max:2048', // 2MB max
    // ];
    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'sku' => 'required|string|max:100|unique:products,sku' . ($this->productId ? ",$this->productId" : ''),
            // 'category_id' => 'required|integer|exists:categories,id',
            'subcategory_id' => 'required|integer|exists:sub_categories,id',
            'images.*' => 'image|max:2048', // Image validation
            'image' => 'nullable|max:2048', // 2MB max
        ];
    }

    // public function mount()
    // {
    //     $this->categories = Category::first();//all();
    //     $this->subcategories = SubCategory::all();
    // }
    public function mount($id = null)
    {
        if ($id) {
            $this->isEditing = true;
            $this->productId = $id;
            $this->editProduct($id);  // Load the product details if we're editing
            // $this->loadProduct();
        } else {
            $this->categories = Category::all();
            // $this->category_id = $this->categories->id;
            $this->subcategories = SubCategory::all();
        }
    }
    
    public function render()
    {
        $this->categories = Category::first();//all();
        $this->subcategories = SubCategory::all();
        return view('livewire.admin.product.create')->layout('admin.layouts.app');
    }

    public function resetFields()
    {
        $this->name = $this->description = $this->price = $this->stock = $this->sku = $this->category_id = $this->image = $this->productId = null;
        $this->isEditing = false;
        $this->variants = [];
        $this->images = [];
    }
    
    public function resetVariantForm()
    {
        $this->variant_name = $this->variant_value = $this->variant_price = $this->variant_stock = null;
    }

    public function createProduct()
    {
        $this->validate();

        // if ($this->image) {
        //     $imagePath = $this->image->store('products', 'public');
        // }
        // dd($this->subcategory_id);
        $filename = time() . '_' . uniqid() . '.' . $this->image->getClientOriginalExtension();
        $product_image_path = $this->image->storeAs('product_images', $filename, 'public');
        $product = Product::create([
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'stock' => $this->stock,
            'sku' => $this->sku,
            'category_id' => $this->categories->id,//$this->category_id,
            'subcategory_id' => $this->subcategory_id,
            'image' => $product_image_path//$imagePath ?? null,
        ]);

        // Save Variants
        foreach ($this->variants as $variant) {
            ProductVariant::create([
                'product_id' => $product->id,
                'variant_name' => $variant['name'],
                'variant_value' => $variant['value'],
                'price' => $variant['price'],
                'stock' => $variant['stock'],
            ]);
        }

        // Save Images
        foreach ($this->images as $image) {
            $path = $image->store('product_images');
            ProductImage::create([
                'product_id' => $product->id,
                'image_path' => $path,
                'is_main' => false,
            ]);
        }
        $this->products = Product::with('variants', 'images')->get();
        session()->flash('message', 'Product created successfully.');
        $this->resetFields();
    }

    public function addVariant()
    {
        $this->variants[] = [
            'name' => $this->variant_name,
            'value' => $this->variant_value,
            'price' => $this->variant_price,
            'stock' => $this->variant_stock,
        ];

        $this->resetVariantForm();
    }
    
    public function editProduct($id)
    {
        $product = Product::with('variants', 'images')->findOrFail($id);
        $this->productId = $product->id;
        $this->name = $product->name;
        $this->description = $product->description;
        $this->price = $product->price;
        $this->stock = $product->stock;
        $this->sku = $product->sku;
        $this->category_id = $product->category_id;
        $this->variants = $product->variants; // Load product variants
        $this->images = $product->images; // Load product images
        $this->is_disabled = $product->is_disabled; // Load product images
        // $this->isEditing = true; // Set editing mode to true
        // dd($product->variants->toArray());
        $this->variants = $product->variants->toArray(); // Load all variants
        $this->images = $product->images->pluck('image_path')->toArray(); // Load image paths
    }

    public function updateProduct()
    {
        $this->validate();

        $product = Product::findOrFail($this->productId);

        if ($this->image) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $imagePath = $this->image->store('products', 'public');
            $product->image = $imagePath;
        }

        $product->update([
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'stock' => $this->stock,
            'sku' => $this->sku,
            // 'category_id' => 'required|exists:categories,id',
            'category_id' => $this->category_id, // Ensure this is an integer
        ]);

        // Update variants
        // foreach ($this->variants as $variant) {
        //     ProductVariant::updateOrCreate(
        //         ['id' => $variant['id'] ?? null], 
        //         [
        //             'product_id' => $product->id,
        //             'variant_name' => $variant['name'],
        //             'variant_value' => $variant['value'],
        //             'price' => $variant['price'],
        //             'stock' => $variant['stock'],
        //         ]
        //     );
        // }        

        // Update images
        foreach ($this->images as $image) {
            $path = $image->store('product_images');
            ProductImage::create([
                'product_id' => $product->id,
                'image_path' => $path,
                'is_main' => false,
            ]);
        }        
        session()->flash('message', 'Product updated successfully.');
        $this->resetFields();
    }
    
    public function updateVariant($index){

        $variant = $this->variants[$index]; // Access the specific variant by index

        // Validate the variant data
        $this->validate([
            "variants.{$index}.variant_name" => 'required|string|max:255',
            "variants.{$index}.variant_value" => 'required|string|max:255',
            "variants.{$index}.price" => 'required|numeric',
            "variants.{$index}.stock" => 'required|integer',
            "variants.{$index}.is_disabled" => 'boolean',
        ]);
        // if ($this->getTotalVariantStock() != $this->stock) {
        //     session()->flash('error', 'Total variant stock cannot deviate the product quantity.');
        // }
    
        // Perform update on the specific variant
        $productVariant = ProductVariant::findOrFail($variant['id']);
        $productVariant->update([
            'variant_name' => $variant['variant_name'],
            'variant_value' => $variant['variant_value'],
            'price' => $variant['price'],
            'stock' => $variant['stock'],
            'is_disabled' => $variant['is_disabled'],
        ]);
    
        // Optionally, flash a success message
        session()->flash('variant_success_message', 'Variant updated successfully.');
    }

    public function deleteProduct($id)
    {
        $product = Product::findOrFail($id);
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();

        session()->flash('message', 'Product deleted successfully.');
    }

    
    public function setMainImage($imageId)
    {
        $image = ProductImage::find($imageId);

        // Unset the current main image
        ProductImage::where('product_id', $image->product_id)->update(['is_main' => false]);

        // Set the selected image as main
        $image->update(['is_main' => true]);

        $this->products = Product::with('variants', 'images')->get();
        session()->flash('message', 'Main image updated successfully!');
    }

    public function updateImages($productId)
    {
        $this->validate([
            'images.*' => 'image|max:2048',
        ]);

        foreach ($this->images as $image) {
            $path = $image->store('product_images');
            ProductImage::create([
                'product_id' => $productId,
                'image_path' => $path,
                'is_main' => false,
            ]);
        }

        $this->products = Product::with('variants', 'images')->get();
        session()->flash('message', 'Images updated successfully!');
        $this->images = []; // Reset images input
    }

    public function updatedImages()
    {
        $this->validate([
            'images.*' => 'image|max:2048', // 2MB Max
        ]);

        // Generate preview URLs
        $this->previewImages = [];
        foreach ($this->images as $image) {
            $this->previewImages[] = $image->temporaryUrl();
        }
    }

    public function getTotalVariantStock()
    {
        return array_sum(array_column($this->variants, 'stock'));
    }

}
