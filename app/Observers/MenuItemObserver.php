<?php

namespace App\Observers;

use App\Models\SubCategory;
use Illuminate\Support\Facades\Cache;

class MenuItemObserver
{
    public function saved(SubCategory $menuItem)
    {
        Cache::forget('header_menu_items');
    }

    public function deleted(SubCategory $menuItem)
    {
        Cache::forget('header_menu_items');
    }
}
