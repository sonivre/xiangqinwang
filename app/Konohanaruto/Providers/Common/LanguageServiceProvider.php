<?php
/**
 * Created by PhpStorm.
 * User: konohanaruto
 * Blog: http://www.muyesanren.com
 * QQ: 1039814413
 * Wechat Number: wikitest
 * Date: 2017/10/1
 * Time: 9:52
 */
namespace App\Konohanaruto\Providers\Common;

use Illuminate\Support\ServiceProvider;
use App;

class LanguageServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // 设置默认语言
        App::setLocale('zh-cn');
    }
}