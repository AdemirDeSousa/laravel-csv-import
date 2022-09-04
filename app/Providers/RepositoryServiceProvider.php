<?php

namespace App\Providers;

use App\Repositories\Contracts\ClientRepositoryInterface;
use App\Repositories\Contracts\FreightRepositoryInterface;
use App\Repositories\Eloquent\Clients\ClientRepository;
use App\Repositories\Eloquent\Freights\FreightRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ClientRepositoryInterface::class, ClientRepository::class);
        $this->app->bind(FreightRepositoryInterface::class, FreightRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
