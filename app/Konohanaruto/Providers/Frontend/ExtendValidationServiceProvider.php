<?php
/**
 * Created by PhpStorm.
 * File: ExtendValidationServiceProvider.php
 * User: konohanaruto
 * Blog: http://www.muyesanren.com
 * QQ: 1039814413
 * Wechat Number: wikitest
 * Date: 9/24/2017
 * Time: 7:28 PM
 */

namespace App\Konohanaruto\Providers\Frontend;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class ExtendValidationServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // rule: register_username
        Validator::extend('register_username', function ($attribute, $username) {
            $usernameCharacter = strlen($username);
            // 用户名必须是任意的汉字、字母、数字或下划线，但不能以下划线开头和结尾
            $reg = '/^(?!_)\w+(?<!_)$/u';

            if ($usernameCharacter > 24 || ! preg_match($reg, $username)) {
                return false;
            }

            return true;
        });

        // rule: is_mobile
        Validator::extend('is_mobile', function ($attribute, $mobile) {
            $reg = '/^((13[0-9])|(15[^4])|(18[0,2,3,5-9])|(17[0-8])|(147))\d{8}$/';

            if (! preg_match($reg, $mobile)) {
                return false;
            }

            return true;
        });

        // rule: six_number  验证短信验证码使用，必须是6位数的数字
        Validator::extend('six_number', function ($attribute, $field) {
            $reg = '/^\d{6}$/';

            if (! preg_match($reg, $field)) {
                return false;
            }

            return true;
        });
    }
}