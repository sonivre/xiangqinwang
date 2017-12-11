<?php
/**
 * Created by PhpStorm.
 * File: FileStorageServiceProvider.php
 * User: konohanaruto
 * Blog: http://www.muyesanren.com
 * QQ: 1039814413
 * Wechat Number: wikitest
 * Date: 12/3/2017
 * Time: 6:52 PM
 */

namespace App\Konohanaruto\Providers\Intranet;

use App\Konohanaruto\Services\Common\LocalFileStorageService;
use App\Konohanaruto\Services\Common\QiniuStorageService;
use App\Konohanaruto\Services\Intranet\FileStorageServiceInterface;
use Illuminate\Support\ServiceProvider;

class FileStorageServiceProvider extends ServiceProvider
{
    public function register()
    {
//        $this->app->bind(
//            FileStorageServiceInterface::class,
//            QiniuStorageService::class
//        );
        $this->app->bind(
            FileStorageServiceInterface::class,
            LocalFileStorageService::class
        );
    }
}

