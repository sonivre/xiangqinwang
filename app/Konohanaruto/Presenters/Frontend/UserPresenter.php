<?php
/**
 * Created by PhpStorm.
 * User: konohanaruto
 * Blog: http://www.muyesanren.com
 * QQ: 1039814413
 * Wechat Number: wikitest
 * Date: 2018/1/15
 * Time: 21:03
 */

namespace App\Konohanaruto\Presenters\Frontend;
use App\Konohanaruto\Repositories\Frontend\User\UserRepositoryInterface;

class UserPresenter
{
    public function userAvatarVerifyStatusText($avatarVerifyStatus)
    {
        switch ($avatarVerifyStatus) {
            case -1:
                $text = '头像审核中';
                break;
            case 0:
                $text = '非真人头像';
                break;
            case 1:
                $text = '';
                break;
            default:
                $text = '';
        }

        return $text;
    }

    public function showAvatarTips($avatarVerifyStatus)
    {
        return $avatarVerifyStatus == 1 ? "hide" : "";
    }

    /**
     * 提供个人中心页面的背景颜色样式
     *
     * @param $userId
     * @return string
     */
    public function detectMyAccoutBackgroundByUserId($userId)
    {
        // 得到用户性别
        $userRepo = app(UserRepositoryInterface::class);
        $userInfo = $userRepo->userInfo($userId);

        return $userInfo['gender'] == 1 ? 'profile-male' : 'profile-female';
    }
}