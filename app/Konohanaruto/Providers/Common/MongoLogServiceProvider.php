<?php

namespace App\Konohanaruto\Providers\Common;

use Illuminate\Support\ServiceProvider;
use Log;

class MongoLogServiceProvider extends ServiceProvider
{
    
    const MONGO_LOG_COLLECTION = 'logs';
    
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $monolog = Log::getMonolog();
        $mongoHost = env('MONGO_DB_HOST');
        $mongoPort = env('MONGO_DB_PORT');
        $mongoDatabase = env('MONGO_DB_DATABASE');
        $mongoDsn = 'mongodb://' . $mongoHost . ':' . $mongoPort;
        $mongoHandler = new \Monolog\Handler\MongoDBHandler(new \MongoClient($mongoDsn), $mongoDatabase, self::MONGO_LOG_COLLECTION);
        $monolog->pushHandler($mongoHandler);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        
    }
}
