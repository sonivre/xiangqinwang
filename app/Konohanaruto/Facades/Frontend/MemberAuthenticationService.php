<?php
/**
 * Created by PhpStorm.
 * User: konohanaruto
 * Blog: http://www.muyesanren.com
 * QQ: 1039814413
 * Wechat Number: wikitest
 * Date: 2017/9/30
 * Time: 10:06
 */

namespace App\Konohanaruto\Facades\Frontend;

use Illuminate\Support\Facades\Facade;

class MemberAuthenticationService extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'MemberAuthenticationService';
    }
}