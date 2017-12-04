<?php
/**
 * Created by PhpStorm.
 * File: RedisDataService.php
 * User: konohanaruto
 * Blog: http://www.muyesanren.com
 * QQ: 1039814413
 * Wechat Number: wikitest
 * Date: 12/3/2017
 * Time: 5:56 PM
 */

namespace App\Konohanaruto\Services\Intranet;

use Illuminate\Support\Facades\Redis;

class RedisDataService
{
    use \App\Konohanaruto\Traits\Intranet\RedisConfig;

    public function updateUserInfo($data)
    {
        Redis::hmset($this->getUserInfoKey(), $data);
    }

    public function updateTempData($data)
    {
        Redis::hmset($this->tempCacheKey(), $data);
    }
}