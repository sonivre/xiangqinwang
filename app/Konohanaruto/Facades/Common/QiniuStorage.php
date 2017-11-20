<?php
/**
 * Created by PhpStorm.
 * File: QiniuStorage.php
 * User: konohanaruto
 * Blog: http://www.muyesanren.com
 * QQ: 1039814413
 * Wechat Number: wikitest
 * Date: 11/20/2017
 * Time: 12:04 AM
 */

namespace App\Konohanaruto\Facades\Common;

use Illuminate\Support\Facades\Facade;

class QiniuStorage extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'QiniuStorage';
    }
}