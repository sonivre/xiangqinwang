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
    }
}