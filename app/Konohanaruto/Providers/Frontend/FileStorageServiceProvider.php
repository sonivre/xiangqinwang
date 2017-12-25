<?php
/**
 * Created by PhpStorm.
 * File: FileStorageServiceProvider.php
 * User: konohanaruto
 * Blog: http://www.muyesanren.com
 * QQ: 1039814413
 * Wechat Number: wikitest
 * Date: 12/24/2017
 * Time: 5:38 PM
 */

namespace App\Konohanaruto\Providers\Frontend;

use App\Konohanaruto\Services\Frontend\LocalFileStorageService;
use App\Konohanaruto\Services\Frontend\FileStorageServiceInterface;
use Illuminate\Support\ServiceProvider;

class FileStorageServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            FileStorageServiceInterface::class,
            LocalFileStorageService::class
        );
    }
}