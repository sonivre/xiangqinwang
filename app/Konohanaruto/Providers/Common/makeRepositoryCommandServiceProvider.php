<?php

namespace App\Konohanaruto\Providers\Common;

use Illuminate\Support\ServiceProvider;
use App\Konohanaruto\Infrastructures\Common\BaseGenerateRepository;
use App\Konohanaruto\Infrastructures\Common\GenerateRepository;

class makeRepositoryCommandServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(BaseGenerateRepository::class, GenerateRepository::class);
    }
}