<?php

namespace App\Livewire\Admin\Product;

use App\Models\Product;
use App\Models\Category;
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
    public $name, $description, $price, $stock, $sku, $category_id, $image, $productId, $categories, $subcategories;
    
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
            'category_id' => 'required|integer|exists:categories,id',
            'images.*' => 'image|max:2048', // Image validation
        ];
    }

    public function mount()
    {
        $this->categories = Category::first();//all();
        $this->subcategories = SubCategory::all();
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

        $product = Product::create([
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'stock' => $this->stock,
            'sku' => $this->sku,
            'category_id' => $this->category_id,
            'image' => $imagePath ?? null,
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
        $product = Product::findOrFail($id);
        $this->productId = $product->id;
        $this->name = $product->name;
        $this->description = $product->description;
        $this->price = $product->price;
        $this->stock = $product->stock;
        $this->sku = $product->sku;
        $this->category_id = $product->category_id;
        $this->image = null;
        $this->isEditing = true;
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

        session()->flash('message', 'Product updated successfully.');
        $this->resetFields();
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
}
