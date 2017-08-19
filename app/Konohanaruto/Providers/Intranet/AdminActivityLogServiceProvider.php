<?php

namespace App\Konohanaruto\Providers\Intranet;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Application;
use App\Konohanaruto\Repositories\Intranet\AdminActivity\AdminActivityRepositoryInterface;
use App\Konohanaruto\Repositories\Intranet\AdminActivity\AdminActivityEloquentRepository;

class AdminActivityLogServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            AdminActivityRepositoryInterface::class,
            function (Application $app) {
                /** @var AdminLogRepositoryInterface $repository */
                return app(AdminActivityEloquentRepository::class);
            }
        );
    }
}