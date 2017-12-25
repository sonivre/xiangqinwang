<?php
/**
 * Created by PhpStorm.
 * File: SessionService.php
 * User: konohanaruto
 * Blog: http://www.muyesanren.com
 * QQ: 1039814413
 * Wechat Number: wikitest
 * Date: 12/25/2017
 * Time: 12:23 AM
 */

namespace App\Konohanaruto\Facades\Frontend;

use Illuminate\Support\Facades\Facade;

class SessionService extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'SessionFront';
    }
}