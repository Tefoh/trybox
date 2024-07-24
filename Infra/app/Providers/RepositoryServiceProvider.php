<?php

namespace App\Providers;

use App\Repositories\CustomerAddressRepository;
use App\Repositories\ProductRepository;
use App\Repositories\StoreRepository;
use App\Repositories\UserRepository;
use Core\Repositories\CustomerAddressRepositoryInterface;
use Core\Repositories\ProductRepositoryInterface;
use Core\Repositories\StoreRepositoryInterface;
use Core\Repositories\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            UserRepositoryInterface::class,
            UserRepository::class,
        );
        $this->app->bind(
            CustomerAddressRepositoryInterface::class,
            CustomerAddressRepository::class,
        );
        $this->app->bind(
            ProductRepositoryInterface::class,
            ProductRepository::class,
        );
        $this->app->bind(
            StoreRepositoryInterface::class,
            StoreRepository::class,
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
