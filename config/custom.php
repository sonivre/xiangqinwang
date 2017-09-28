<?php
/**
 * Created by PhpStorm.
 * User: konohanaruto
 * Date: 2017/3/26
 * Time: 11:07
 */

return array(
    // 静态文件服务器
    'staticServer' => 'http://image.xqw.test',
    'staticServerIntranet' => 'http://image.xqw.test/Intranet',
    // 淘宝ip地址库
    'ipTaobaoMap' => 'http://ip.taobao.com//service/getIpInfo.php?ip=',
    // 后台session名
    'intranetSessionName' => 'intranet',
    // 阿里云 sms
    'aliyunSMS' => array(
        'accessKeyId'    => env('ALIYUN_ACCESS_ID', ''),
        'accessKeySecret' => env('ALIYUN_ACCESS_SECRET', ''),
    ),
    // 短信验证码list名
    'REDIS_MOBILE_CODE_KEY' => 'mobile_verify_code',
    //短信验证队列名
    'REDIS_MOBILE_CODE_QUEUE' => 'mobile_verify_code_queue',
    // 短信验证码有效时长， 单位：秒
    'MOBILE_CODE_EXPIRE' => 5*60,
    // 重新请求验证码间隔时间
    'MOBILE_CODE_REFETCH_INTERVAL' => 60,
    'MOBILE_CODE_TYPE' => array(
        'T1' => 'register',
        'T2' => 'forget',
    ),


);
