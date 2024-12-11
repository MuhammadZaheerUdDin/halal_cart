<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductComponent extends Component
{
    public $products, $name, $description, $price, $stock, $sku, $image, $productId;

    public $isEditing = false;

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'required|numeric|min:0',
        'stock' => 'required|integer|min:0',
        'sku' => 'required|string|max:255|unique:products,sku',
        'image' => 'nullable|image|max:2048', // 2MB max
    ];

    public function render()
    {
        $this->products = Product::all();
        return view('livewire.admin.product')->layout('layouts.app');;
    }

    public function resetFields()
    {
        $this->name = $this->description = $this->price = $this->stock = $this->sku = $this->image = $this->productId = null;
        $this->isEditing = false;
    }

    public function createProduct()
    {
        $this->validate();

        if ($this->image) {
            $imagePath = $this->image->store('products', 'public');
        }

        Product::create([
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'stock' => $this->stock,
            'sku' => $this->sku,
            'image' => $imagePath ?? null,
        ]);

        session()->flash('message', 'Product created successfully.');
        $this->resetFields();
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
}
