<?php

namespace App\Konohanaruto\Providers\Frontend;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            'App\Konohanaruto\Repositories\Frontend\User\UserRepository',
            'App\Konohanaruto\Repositories\Frontend\User\UserRegisterRepository'
        );

        $this->app->bind(
            'App\Konohanaruto\Repositories\Frontend\User\UserRepositoryInterface',
            'App\Konohanaruto\Repositories\Frontend\User\UserEloquentRepository'
        );
    }
}