<?php

namespace App\Konohanaruto\Providers\Intranet;
use Illuminate\Support\ServiceProvider;

class RegisterRevenueServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            'App\Konohanaruto\Repositories\Intranet\RegisterRevenue\RegisterRevenueRepositoryInterface',
            'App\Konohanaruto\Repositories\Intranet\RegisterRevenue\RegisterRevenueEloquentRepository'
        );
    }
}