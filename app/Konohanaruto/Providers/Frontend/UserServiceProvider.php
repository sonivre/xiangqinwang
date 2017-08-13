<?php
/**
 * Created by PhpStorm.
 * User: konohanaruto
 * Date: 2017/4/6
 * Time: 19:38
 */

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
    }
}