<?php
/**
 * Created by PhpStorm.
 * File: SettingController.php
 * User: konohanaruto
 * Blog: http://www.muyesanren.com
 * QQ: 1039814413
 * Wechat Number: wikitest
 * Date: 12/24/2017
 * Time: 7:28 PM
 */

namespace App\Http\Controllers\Frontend;

use App\Konohanaruto\Services\Frontend\SessionService;
use App\Konohanaruto\Services\Frontend\UserService;
use Illuminate\Http\Request;
use SessionFront;

class SettingController extends BasicController
{
    private $userService;
    private $sessionService;

    public function __construct(UserService $userService, SessionService $sessionService)
    {
        $this->userService = $userService;
        $this->sessionService = $sessionService;
    }

    public function avatarEdit()
    {
        var_dump(SessionFront::getUserId());exit;
        $userInfo = $this->userService->getUserAvatar(1);
        return view('frontend.pages.authed.setting_avatar');
    }
}