<?php
/**
 * Created by PhpStorm.
 * User: konohanaruto
 * Blog: http://www.muyesanren.com
 * QQ: 1039814413
 * Wechat Number: wikitest
 * Date: 2017/9/30
 * Time: 8:41
 */

namespace App\Konohanaruto\Services\Common;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Hash;

class UserDataAccessUniversalService extends BaseService
{
    /**
     * 得到客户端user-agent信息
     *
     * @return mixed
     */
    public function getUserAgent()
    {
        return Request::header('User-Agent');
    }

    /**
     * 得到一个随机的手机验证码，6位数
     *
     * @return int
     */
    public function getMobileVerifyCode()
    {
        return rand(100000, 999999);
    }

    /**
     * 生成会员激活Token
     *
     * @param $userId
     * @param $username
     * @param $email
     * @return mixed
     */
    public function accountMailActivationToken($userId, $username, $email)
    {
        return Hash::make("$userId:$username:$email");
    }
}