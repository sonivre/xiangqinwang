<?php
/**
 * Created by PhpStorm.
 * File: SessionServiceProvider.php
 * User: konohanaruto
 * Blog: http://www.muyesanren.com
 * QQ: 1039814413
 * Wechat Number: wikitest
 * Date: 11/5/2017
 * Time: 4:22 PM
 */

namespace App\Konohanaruto\Providers\Intranet;

use App\Konohanaruto\Services\Intranet\SessionService;
use Illuminate\Support\ServiceProvider;

class SessionServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('SessionService', function () {
            return new SessionService();
        });
    }
}