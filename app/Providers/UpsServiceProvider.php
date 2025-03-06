<?php

namespace App\Providers;
use App\Services\Ups\UpsService;
use Illuminate\Support\ServiceProvider;

class UpsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(UpsService::class, function ($app) {
            return new UpsService();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
