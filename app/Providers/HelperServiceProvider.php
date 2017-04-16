<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class HelperServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $commonPath = app_path() . '/Common';
        if (is_dir($commonPath)) {
            foreach (glob($commonPath . '/*.php') as $file) {
                require_once ($file);
            }
        }
    }
}
