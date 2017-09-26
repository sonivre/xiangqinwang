<?php
/**
 * Created by PhpStorm.
 * User: konohanaruto
 * Date: 2017/4/15
 * Time: 9:10
 */

/**
 * 自定义方法集合
 */
use \Curl\Curl;

if (! function_exists('getUserLocationByIp')) {
    // 得到用户当前位置
    function getUserLocationByIp($ip)
    {
        if (! checkIpAddress($ip)) {
            return false;
        }
        $curl = new Curl();
        $targetUrl = config('custom.ipTaobaoMap') . $ip;
        $addressInfo = $curl->get($targetUrl);
        if ($curl->error) {
            // echo 'Error: ' . $curl->errorCode . ': ' . $curl->errorMessage . "\n";
            return false;
        }
        $info = json_decode($curl->response, true);
        // correct
        if (json_last_error() === JSON_ERROR_NONE) {
            // 失败的ip
            if ($info['code'] == 1) {
                return false;
            }
            return $info['data'];
        }
        return false;
    }
}

if (! function_exists('checkIpAddress')) {
    // 验证ip地址是否有效
    function checkIpAddress($ip)
    {
        if (!filter_var($ip, FILTER_VALIDATE_IP) === false) {
            return true;
        }
        return false;
    }
}

if (! function_exists('verifyPhoneNumber')) {
    // 验证手机号是否有效
    function verifyPhoneNumber($number) {
        $reg = '/^((13[0-9])|(15[^4])|(18[0,2,3,5-9])|(17[0-8])|(147))\d{8}$/';

        return preg_match($reg, $number) ? true : false;
    }
}