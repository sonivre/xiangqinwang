<?php
/**
 * Created by PhpStorm.
 * File: SystemConfig.php
 * User: konohanaruto
 * Blog: http://www.muyesanren.com
 * QQ: 1039814413
 * Wechat Number: wikitest
 * Date: 9/26/2017
 * Time: 12:35 AM
 */

namespace App\Konohanaruto\Infrastructures\Frontend;

class SystemConfig
{
    public $userRegister;

    public function __construct(UserRegisterConfig $userRegister)
    {
        $this->userRegister = $userRegister;
    }
}