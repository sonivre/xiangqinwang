<?php

namespace App\Konohanaruto\Providers\Intranet;
use Illuminate\Support\ServiceProvider;

class AdminActivityLogServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            'App\Konohanaruto\Repositories\Intranet\AdminActivity\AdminLogEloquentRepository',
            'App\Konohanaruto\Repositories\Intranet\AdminActivity\AdminLogRepositoryInterface'
        );
    }
}