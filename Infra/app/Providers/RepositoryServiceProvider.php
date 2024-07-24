<?php

namespace App\Providers;

use App\Repositories\CustomerAddressRepository;
use App\Repositories\UserRepository;
use Core\Repositories\CustomerAddressRepositoryInterface;
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
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
