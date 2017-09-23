<?php
/**
 * Created by PhpStorm.
 * User: konohanaruto
 * Blog: http://www.muyesanren.com
 * QQ: 1039814413
 * Wechat Number: wikitest
 * Date: 2017/9/22
 * Time: 20:24
 */

namespace App\Konohanaruto\Infrastructures\Common\SMS;

interface ShortMessageServiceInterface
{
    /**
     * 发送方法
     */
    public function send($phoneNumbers, $config = array());
}