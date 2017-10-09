<?php

namespace App\Konohanaruto\Providers\Frontend;
use Illuminate\Support\ServiceProvider;

class MemberPictureServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            'App\Konohanaruto\Repositories\Frontend\MemberPicture\MemberPictureRepositoryInterface',
            'App\Konohanaruto\Repositories\Frontend\MemberPicture\MemberPictureEloquentRepository'
        );
    }
}