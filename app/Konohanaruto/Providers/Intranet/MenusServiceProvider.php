<?php

namespace App\Konohanaruto\Providers\Intranet;
use Illuminate\Support\ServiceProvider;

class MenusServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            'App\Konohanaruto\Repositories\Intranet\Menus\MenusRepositoryInterface',
            'App\Konohanaruto\Repositories\Intranet\Menus\MenusEloquentRepository'
        );
    }
}