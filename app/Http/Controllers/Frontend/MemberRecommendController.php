<?php
/**
 * Created by PhpStorm.
 * User: konohanaruto
 * Blog: http://www.muyesanren.com
 * QQ: 1039814413
 * Wechat Number: wikitest
 * Date: 2017/10/16
 * Time: 20:27
 */

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Konohanaruto\Services\Frontend\UserService;
use SessionFront;

class MemberRecommendController extends BasicController
{
    private $userSerivce;

    public function __construct(UserService $userService)
    {
        $this->userSerivce = $userService;
    }

    public function actionHome()
    {
        $userId = SessionFront::getUserId();
        $userInfo = $this->userSerivce->getUserBaseInfoById($userId);

        return view('frontend.pages.authed.home', ['userInfo' => $userInfo]);
    }
}