<?php

namespace App\Konohanaruto\Providers\Frontend;
use Illuminate\Support\ServiceProvider;

class MemberTrendsServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            'App\Konohanaruto\Repositories\Frontend\MemberTrends\MemberTrendsRepositoryInterface',
            'App\Konohanaruto\Repositories\Frontend\MemberTrends\MemberTrendsEloquentRepository'
        );
    }
}