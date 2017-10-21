<?php
/**
 * Created by PhpStorm.
 * User: konohanaruto
 * Blog: http://www.muyesanren.com
 * QQ: 1039814413
 * Wechat Number: wikitest
 * Date: 2017/10/21
 * Time: 9:25
 *
 * 用户访问控制之类的中间层
 * session或cookie写入
 */

namespace App\Konohanaruto\Services\Frontend;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Request;
use App\Konohanaruto\Repositories\Frontend\User\UserRepository;

class MemberAuthenticationService extends BaseService
{
    private $cookiePrefix;
    private $sessionPrefix;
    private $memberCredentialCookie;
    private $memberCredentialSession;

    public function __construct()
    {
        $this->init();
    }

    public function init()
    {
        $this->cookiePrefix = config('custom.frontendCookiePrefix');
        $this->sessionPrefix = config('custom.frontendSessionName');
        $this->memberCredentialCookie = $this->cookiePrefix . '.member.info';
        $this->memberCredentialSession = $this->sessionPrefix . '.member.info';
    }

    public function checkUserLogin()
    {
        if (Cookie::has($this->memberCredentialCookie)) {
            $userInfo = unserialize(Cookie::get($this->memberCredentialCookie));
        } elseif (Session::has($this->memberCredentialSession)) {
            $userInfo = Session::get($this->memberCredentialSession);
        } else {
            $userInfo = array();
        }

        $userRepo = app(UserRepository::class);

        if (! empty($userInfo)) {
            $res = $userRepo->findUser(array(
                array('user_id', '=', $userInfo['user_id']),
                array('username', '=', $userInfo['username']),
                array('email', '=', $userInfo['email']),
                array('emailstatus', '=', 1),
            ));

            return ! empty($res) ? true : false;
        }

        return false;
    }

    /**
     * 删除登录信息cookie
     *
     * @return mixed
     */
    public function forgetUserLoginCookie()
    {
        return Cookie::forget($this->memberCredentialCookie);
    }

    /**
     * 清空session
     */
    public function flushUserSession()
    {
        Session::flush();
    }

    /**
     * 保存登录信息到session
     */
    public function storeUserInfoToSession($data)
    {
        return Session::put($this->memberCredentialSession, $data);
    }

    /**
     * 保存登录信息数据
     *
     * @param $data
     * @return mixed
     */
    public function storeUserInfoToCookie($data)
    {
        return Cookie::make($this->memberCredentialCookie, serialize($data), 7*24*60);
    }
}