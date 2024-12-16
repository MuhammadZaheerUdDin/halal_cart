<?php

namespace App\Livewire\User;

use App\Models\Product;
use App\Models\SubCategory;
use Livewire\Component;

class HomeComponent extends Component
{
    public $products;

    public function mount(){
        // $this->products = Product::all();
    }

    public function render()
    {
        return view('livewire.user.home-component')->layout('layouts.guest');
    }
}
