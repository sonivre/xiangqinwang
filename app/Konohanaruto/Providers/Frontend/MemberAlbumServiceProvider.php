<?php

namespace App\Konohanaruto\Providers\Frontend;
use Illuminate\Support\ServiceProvider;

class MemberAlbumServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            'App\Konohanaruto\Repositories\Frontend\MemberAlbum\MemberAlbumRepositoryInterface',
            'App\Konohanaruto\Repositories\Frontend\MemberAlbum\MemberAlbumEloquentRepository'
        );
    }
}