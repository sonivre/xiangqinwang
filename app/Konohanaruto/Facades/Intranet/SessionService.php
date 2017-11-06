<?php
/**
 * Created by PhpStorm.
 * File: SessionService.php
 * User: konohanaruto
 * Blog: http://www.muyesanren.com
 * QQ: 1039814413
 * Wechat Number: wikitest
 * Date: 11/5/2017
 * Time: 4:20 PM
 */

namespace App\Konohanaruto\Facades\Intranet;

use Illuminate\Support\Facades\Facade;

class SessionService extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'SessionService';
    }
}