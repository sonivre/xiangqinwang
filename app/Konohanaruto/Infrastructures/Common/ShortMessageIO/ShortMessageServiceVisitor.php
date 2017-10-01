<?php
/**
 * Created by PhpStorm.
 * File: ShortMessageServiceVisitor.php
 * User: konohanaruto
 * Blog: http://www.muyesanren.com
 * QQ: 1039814413
 * Wechat Number: wikitest
 * Date: 9/28/2017
 * Time: 6:08 PM
 */

namespace App\Konohanaruto\Infrastructures\Common\ShortMessageIO;

use App\Konohanaruto\Repositories\Frontend\MobileVerifyCode\MobileVerifyCodeRepositoryInterface;
use Redis;


class ShortMessageServiceVisitor
{
    private $repo;
    private $hashKey;

    public function __construct(MobileVerifyCodeRepositoryInterface $repo)
    {
    }

    public function getDataByMobile($phoneNumber)
    {
    }

    public function setData($phoneNumber)
    {

    }
}