<?php
/**
 * Created by PhpStorm.
 * User: konohanaruto
 * Blog: http://www.muyesanren.com
 * QQ: 1039814413
 * Wechat Number: wikitest
 * Date: 2017/9/30
 * Time: 8:49
 */

namespace App\Konohanaruto\Providers\Common;

use App\Konohanaruto\Services\Common\UserDataAccessUniversalService;
use Illuminate\Support\ServiceProvider;

class UserUniversalDataServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('UserUniversalData', function () {
            return new UserDataAccessUniversalService();
        });
    }
}