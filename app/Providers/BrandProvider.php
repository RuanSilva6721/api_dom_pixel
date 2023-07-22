<?php

namespace App\Providers;

use App\Repositories\BrandRepository;
use App\Repositories\Eloquent\BrandRepositoryEloquent;
use Illuminate\Support\ServiceProvider;

class BrandProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(BrandRepository::class, BrandRepositoryEloquent::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
