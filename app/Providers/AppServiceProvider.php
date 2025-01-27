<?php

namespace App\Providers;

use App\Models\Order;
use App\Models\SubCategory;
use App\Observers\MenuItemObserver;
use App\Observers\OrderObserver;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Cache;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        SubCategory::observe(MenuItemObserver::class);
        Order::observe(OrderObserver::class);
    }
}
