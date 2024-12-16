<?php

namespace App\Livewire\Admin\Category;

use App\Models\Category as ModelsCategory;
use Livewire\Component;

class CategoryComponent extends Component
{
    public $categories, $name, $description, $categoryId;

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
    ];

    public function mount() 
    {
        $this->categories = ModelsCategory::all();
    }

    public function render()
    {
        //ModelsCategory::all();
        return view('livewire.admin.category.category')->layout('admin.layouts.app');
    }

    public function createCategory()
    {
        $this->validate();
        
        ModelsCategory::create([
            'name' => $this->name,
            'slug' => $this->name,
            'description' => $this->description,
        ]);

        session()->flash('message', 'Category created successfully!');
        $this->resetForm();
        $this->mount(); // Refresh category list
    }

    public function editCategory($id)
    {
        $category = ModelsCategory::find($id);
        $this->categoryId = $category->id;
        $this->name = $category->name;
        $this->description = $category->description;
    }

    public function updateCategory()
    {
        $this->validate();

        $category = ModelsCategory::find($this->categoryId);
        $category->update([
            'name' => $this->name,
            'description' => $this->description,
        ]);

        session()->flash('message', 'Category updated successfully!');
        $this->resetForm();
        $this->mount(); // Refresh category list
    }

    public function deleteCategory($id)
    {
        ModelsCategory::find($id)->delete();
        session()->flash('message', 'Category deleted successfully!');
        $this->mount(); // Refresh category list
    }

    public function resetForm()
    {
        $this->name = '';
        $this->description = '';
        $this->categoryId = null;
    }
}
