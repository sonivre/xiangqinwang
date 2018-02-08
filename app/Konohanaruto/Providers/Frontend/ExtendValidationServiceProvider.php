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
use Log;

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

        /** 关于参数的说明
         *  根据源码：
         *  vendor/laravel/framework/src/Illuminate/Validation/Validator.php 第 352行得出，有四个参数
         *  例如： str_length:1,10 参数结果 string(10) ["1","10"]
         *  参数可以通过$paramaters[下标]进行访问
         *  $this->$method($attribute, $value, $parameters, $this)
         */
        validator::extend('str_length', function ($attribute, $value, $paramaters, $validator) {
            // 计算非中文字符长度
            $asciiLength = strlen(preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $value));
            // 中文字符长度，改为中文占两个字符，php默认是3
            $unAsciiLength = (strlen($value) - $asciiLength) / 3 * 2;
            $length = $asciiLength + $unAsciiLength;

            return $length >= $paramaters[0] && $length <= $paramaters[1] ? true : false;
        });
    }
}