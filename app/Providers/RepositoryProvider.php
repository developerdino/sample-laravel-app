<?php

namespace App\Providers;

use App\Contracts\Repositories\CategoryRepositoryInterface;
use App\Contracts\Repositories\ProductRepositoryInterface;
use App\Repositories\Cache\CachingCategoryRepository;
use App\Repositories\Cache\CachingProductRepository;
use App\Repositories\Eloquent\EloquentCategoryRepository;
use App\Repositories\Eloquent\EloquentProductRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            CategoryRepositoryInterface::class,
            function () {
                $repository = new EloquentCategoryRepository;

                return new CachingCategoryRepository($repository, $this->app['cache.store']);
            }
        );

        $this->app->singleton(
            ProductRepositoryInterface::class,
            function () {
                $repository = new EloquentProductRepository;

                return new CachingProductRepository($repository, $this->app['cache.store']);
            }
        );
    }
}
