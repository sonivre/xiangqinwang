<?php

namespace App\Konohanaruto\Providers\Intranet;
use Illuminate\Support\ServiceProvider;

class UserRoleServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            'App\Konohanaruto\Repositories\Intranet\UserRole\UserRoleRepositoryInterface',
            'App\Konohanaruto\Repositories\Intranet\UserRole\UserRoleEloquentRepository'
        );
    }
}