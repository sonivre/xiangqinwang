<?php

namespace App\Konohanaruto\Providers\Intranet;
use Illuminate\Support\ServiceProvider;

class MemberGiftTypeServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            'App\Konohanaruto\Repositories\Intranet\MemberGiftType\MemberGiftTypeRepositoryInterface',
            'App\Konohanaruto\Repositories\Intranet\MemberGiftType\MemberGiftTypeEloquentRepository'
        );
    }
}