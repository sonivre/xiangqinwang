<?php
/**
 * Created by PhpStorm.
 * User: konohanaruto
 * Blog: http://www.muyesanren.com
 * QQ: 1039814413
 * Wechat Number: wikitest
 * Date: 2017/9/22
 * Time: 21:34
 */

namespace App\Konohanaruto\Providers\Common;

use Illuminate\Support\ServiceProvider;
use App\Konohanaruto\Infrastructures\Common\SMS\ShortMessageServiceInterface;
use App\Konohanaruto\Infrastructures\Common\SMS\AliyunShortMessageService;

class AliyunShortMessageServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(ShortMessageServiceInterface::class, AliyunShortMessageService::class);
    }
}