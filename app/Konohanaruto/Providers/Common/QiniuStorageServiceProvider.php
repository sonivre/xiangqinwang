<?php
/**
 * Created by PhpStorm.
 * File: QiniuStorageServiceProvider.php
 * User: konohanaruto
 * Blog: http://www.muyesanren.com
 * QQ: 1039814413
 * Wechat Number: wikitest
 * Date: 11/20/2017
 * Time: 12:00 AM
 */

namespace App\Konohanaruto\Providers\Common;

use App\Konohanaruto\Services\Common\QiniuStorageService;
use Illuminate\Support\ServiceProvider;

class QiniuStorageServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('QiniuStorage', function () {
            return new QiniuStorageService();
        });
    }
}