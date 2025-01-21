<?php

namespace App\Livewire\Admin\Category;

use App\Models\Category;
use App\Models\SubCategory;
use Livewire\Component;
use Livewire\WithFileUploads;

class SubCategoryComponent extends Component
{
    use WithFileUploads;
    public $subcategories, $categories;
    public $name, $description, $category_id, $subcategoryId ,$image;
    public $isEditing = false;

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'category_id' => 'required|exists:categories,id',
        'image' => 'nullable',
    ];

    public function mount()
    {
        $this->categories = Category::all(); // Fetch all categories
        $this->subcategories = SubCategory::with('category')->get();
    }

    public function render()
    {
        return view('livewire.admin.category.sub-category-component')->layout('admin.layouts.app');
    }

    public function createSubcategory()
    {
        $this->validate();
        $product_image_path = '';
        if(!empty($this->image)){
            $filename = time() . '_' . uniqid() . '.' . $this->image->getClientOriginalExtension();
            $product_image_path = $this->image->storeAs('sub_category_images', $filename, 'public');
        }
        Subcategory::create([
            'name' => $this->name,
            'description' => $this->description,
            'category_id' => $this->category_id,
            'image' => $product_image_path,
        ]);

        $this->resetForm();
        // $this->image->store('product_images');
        $this->subcategories = Subcategory::with('category')->get();
        session()->flash('message', 'Subcategory created successfully!');
    }
    public function editSubcategory($id)
    {
        $subcategory = Subcategory::findOrFail($id);

        $this->subcategoryId = $subcategory->id;
        $this->name = $subcategory->name;
        $this->description = $subcategory->description;
        $this->category_id = $subcategory->category_id;
        $this->image = null;//$subcategory->image;
        $this->isEditing = true;
    }

    public function updateSubcategory()
    {
        $this->validate();

        $subcategory = Subcategory::findOrFail($this->subcategoryId);
        $product_image_path = '';
        if(!empty($this->image)){
            $filename = time() . '_' . uniqid() . '.' . $this->image->getClientOriginalExtension();
            $product_image_path = $this->image->storeAs('sub_category_images', $filename, 'public');
        }

        $sub_category = [
            'name' => $this->name,
            'description' => $this->description,
            'category_id' => $this->category_id,            
        ];
        if (!empty($product_image_path)) {
            $sub_category['image'] = $product_image_path;
        }
        $subcategory->update($sub_category);

        $this->resetForm();
        $this->subcategories = Subcategory::with('category')->get();
        session()->flash('message', 'Subcategory updated successfully!');
    }

    public function deleteSubcategory($id)
    {
        Subcategory::findOrFail($id)->delete();
        $this->subcategories = Subcategory::with('category')->get();
        session()->flash('message', 'Subcategory deleted successfully!');
    }

    public function resetForm()
    {
        $this->name = $this->description = $this->category_id = $this->image = null;
        $this->isEditing = false;
    }
}
