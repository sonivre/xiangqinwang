<?php
/**
 * Created by PhpStorm.
 * File: RedisConfig.php
 * User: konohanaruto
 * Blog: http://www.muyesanren.com
 * QQ: 1039814413
 * Wechat Number: wikitest
 * Date: 12/3/2017
 * Time: 5:18 PM
 */

namespace App\Konohanaruto\Traits\Intranet;

trait RedisConfig
{
    use \App\Konohanaruto\Traits\Common\RedisConfig;

    private $redisModuleName;
    private $basePrefix;

    public function __construct()
    {
        $this->basePrefix = $this->redisKeyPrefix
        . $this->redisKeyDelimiter
        . $this->redisModuleName
        . $this->redisKeyDelimiter;

        $this->redisModuleName = config('custom.INTRANET_MODULE_NAME');
    }

    public function getUserInfoKey()
    {
       return $this->basePrefix . 'userinfo';
    }

    public function tempCacheKey()
    {
        return $this->basePrefix . 'tempdata';
    }
}