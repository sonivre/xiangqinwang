<?php
/**
 * Created by PhpStorm.
 * User: konohanaruto
 * Blog: http://www.muyesanren.com
 * QQ: 1039814413
 * Wechat Number: wikitest
 * Date: 2017/9/30
 * Time: 11:23
 */

namespace App\Konohanaruto\Services\Frontend;

class ConfigService extends BaseService
{
    static public $data = array();

    public function set($key, $value = null)
    {
        $this->key = $value;
    }

    public function get($key)
    {
        return empty($this->$key) ? null : $this->$key;
    }
}