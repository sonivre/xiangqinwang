<?php

namespace App\Konohanaruto\Providers\Frontend;
use Illuminate\Support\ServiceProvider;

class MobileVerifyCodeServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            'App\Konohanaruto\Repositories\Frontend\MobileVerifyCode\MobileVerifyCodeRepositoryInterface',
            'App\Konohanaruto\Repositories\Frontend\MobileVerifyCode\MobileVerifyCodeEloquentRepository'
        );
    }
}