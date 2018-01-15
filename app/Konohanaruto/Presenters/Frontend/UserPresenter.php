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
}