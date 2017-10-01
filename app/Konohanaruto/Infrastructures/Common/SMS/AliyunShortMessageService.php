<?php
/**
 * Created by PhpStorm.
 * User: konohanaruto
 * Blog: http://www.muyesanren.com
 * QQ: 1039814413
 * Wechat Number: wikitest
 * Date: 2017/9/22
 * Time: 20:28
 */

namespace App\Konohanaruto\Infrastructures\Common\SMS;

use Aliyun\Core\Config;
use Aliyun\Core\Profile\DefaultProfile;
use Aliyun\Core\DefaultAcsClient;
use Aliyun\Api\Sms\Request\V20170525\SendSmsRequest;
use Aliyun\Api\Sms\Request\V20170525\QuerySendDetailsRequest;
use Log;


class AliyunShortMessageService implements ShortMessageServiceInterface
{

    // 短信API产品名
    private $product = 'Dysmsapi';

    // 短信API产品域名
    private $domain = 'dysmsapi.aliyuncs.com';

    // 暂时不支持多Region
    private $region = 'cn-hangzhou';

    // 服务结点
    private $endPointName = 'cn-hangzhou';

    private $accessKeyId;

    private $accessKeySecret;

    // 签名
    private $signName;

    // 模版码
    private $templateCode;


    public function __construct()
    {
        Config::load();
        $this->accessKeyId = env('ALIYUN_SMS_KEY');
        $this->accessKeySecret = env('ALIYUN_SMS_SECRET');
        $this->signName = env('ALIYUN_SMS_SIGNNAME');
        $this->templateCode = env('ALIYUN_SMS_TEMPLATECODE');

        // 初始化用户Profile实例
        $profile = DefaultProfile::getProfile($this->region, $this->accessKeyId, $this->accessKeySecret);
        // 增加服务结点
        DefaultProfile::addEndpoint($this->endPointName, $this->region, $this->product, $this->domain);
        // 初始化AcsClient用于发起请求
        $this->acsClient = new DefaultAcsClient($profile);
    }


    public function send($phoneNumbers, $config = array())
    {
        // TODO: Implement send() method.

        $templateParam = array();
        $templateParam['code'] = ! empty($config['code']) ? (int) $config['code'] : rand(100000, 999999);
        $outId = ! empty($config['out_id']) ? (int) $config['out_id'] : null;

        // 初始化SendSmsRequest实例用于设置发送短信的参数
        $request = new SendSmsRequest();

        // 必填，设置雉短信接收号码
        $request->setPhoneNumbers($phoneNumbers);

        // 必填，设置签名名称
        $request->setSignName($this->signName);

        // 必填，设置模板CODE
        $request->setTemplateCode($this->templateCode);

        // 可选，设置模板参数
        $request->setTemplateParam(json_encode($templateParam));

        // 可选，设置流水号
        if ($outId) {
            $request->setOutId($outId);
        }

        // 发起访问请求
        return $this->acsClient->getAcsResponse($request);
    }
}