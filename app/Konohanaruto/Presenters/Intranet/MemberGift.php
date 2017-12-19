<?php
/**
 * Created by PhpStorm.
 * User: konohanaruto
 * Blog: http://www.muyesanren.com
 * QQ: 1039814413
 * Wechat Number: wikitest
 * Date: 2017/12/18
 * Time: 20:13
 */

namespace App\Konohanaruto\Presenters\Intranet;

class MemberGift
{
    public function isOnlyVipChecked($radioValue, $isVip, $optional = null)
    {
        if (is_null($isVip)) {
            return $optional == 'default' ? 'checked' : '';
        }

        return $radioValue == $isVip ? 'checked' : '';
    }
}