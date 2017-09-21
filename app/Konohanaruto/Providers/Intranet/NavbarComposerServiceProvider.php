<?php

namespace App\Konohanaruto\Providers\Intranet;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class NavbarComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // 我只让它分配给左侧菜单使用
        view::composer('intranet.includes.left-menu', 'App\Konohanaruto\ViewComposers\Intranet\NavbarComposer@leftNavbar');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
