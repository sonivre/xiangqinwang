<?php
/**
 * Created by PhpStorm.
 * File: RedisConfig.php
 * User: konohanaruto
 * Blog: http://www.muyesanren.com
 * QQ: 1039814413
 * Wechat Number: wikitest
 * Date: 12/3/2017
 * Time: 5:27 PM
 */

namespace App\Konohanaruto\Traits\Common;

trait RedisConfig
{
    protected $redisKeyPrefix = 'xiangqinwang';
    protected $redisKeyDelimiter = ':';
}