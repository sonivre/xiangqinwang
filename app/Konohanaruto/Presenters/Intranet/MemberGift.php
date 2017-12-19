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
    /**
     * 初始化is vip的radio单选框，以及它的选中状态
     *
     * @param $radioValue "radio"的"value"值
     * @param $isVip 落定数据值
     * @param null $optional 当值为default时，代表表单初始化
     * @return string
     */
    public function isOnlyVipChecked($radioValue, $isVip, $optional = null)
    {
        if (is_null($isVip)) {
            return $optional == 'default' ? 'checked' : '';
        }

        return $radioValue == $isVip ? 'checked' : '';
    }

    /**
     * 初始化is valid的radio单选框，以及它的选中状态
     *
     * @param $radioValue "radio"的"value"值
     * @param $isValid 落定数据值
     * @param null $optional 当值为default时，代表表单初始化
     * @return string
     */
    public function isValidChecked($radioValue, $isValid, $optional = null)
    {
        if (is_null($isValid)) {
            return $optional == 'default' ? 'checked' : '';
        }

        return $radioValue == $isValid ? 'checked' : '';
    }
}