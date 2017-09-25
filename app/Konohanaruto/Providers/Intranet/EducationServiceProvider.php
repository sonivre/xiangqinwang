<?php

namespace App\Konohanaruto\Providers\Intranet;
use Illuminate\Support\ServiceProvider;

class EducationServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            'App\Konohanaruto\Repositories\Intranet\Education\EducationRepositoryInterface',
            'App\Konohanaruto\Repositories\Intranet\Education\EducationEloquentRepository'
        );
    }
}