<?php
/**
 * Created by PhpStorm.
 * File: SessionServiceProvider.php
 * User: konohanaruto
 * Blog: http://www.muyesanren.com
 * QQ: 1039814413
 * Wechat Number: wikitest
 * Date: 12/25/2017
 * Time: 12:24 AM
 */

namespace App\Konohanaruto\Providers\Frontend;

use App\Konohanaruto\Services\Frontend\SessionService;
use Illuminate\Support\ServiceProvider;

class SessionServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('SessionFront', function () {
            return new SessionService();
        });
    }
}