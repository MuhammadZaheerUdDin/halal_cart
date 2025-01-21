<?php

namespace App\Livewire\User;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class HeaderMenu extends Component
{
    public $header_menu_items = [];

    public function mount()
    {
        Cache::forget('header_menu_items');
        // Retrieve menu items from cache or database
        $this->header_menu_items = Cache::remember('header_menu_items', 60 * 60, function () {
            // Replace with your query to fetch dynamic menu items
            return SubCategory::select('name','slug','image')->where('status', 1)
                ->orderBy('position', 'asc')
                ->get()
                ->toArray();
        });

    }

    public function render()
    {
        return view('livewire.user.header-menu');
    }
}
