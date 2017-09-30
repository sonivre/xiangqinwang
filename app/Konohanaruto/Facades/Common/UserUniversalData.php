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

namespace App\Konohanaruto\Facades\Common;

use Illuminate\Support\Facades\Facade;

class UserUniversalData extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'UserUniversalData';
    }
}