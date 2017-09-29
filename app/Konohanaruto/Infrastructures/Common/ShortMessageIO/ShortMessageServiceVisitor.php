<?php
/**
 * Created by PhpStorm.
 * File: ShortMessageServiceVisitor.php
 * User: konohanaruto
 * Blog: http://www.muyesanren.com
 * QQ: 1039814413
 * Wechat Number: wikitest
 * Date: 9/28/2017
 * Time: 6:08 PM
 */

namespace App\Konohanaruto\Infrastructures\Common\ShortMessageIO;

use App\Konohanaruto\Repositories\Frontend\MobileVerifyCode\MobileVerifyCodeRepositoryInterface;
use Redis;

class ShortMessageServiceVisitor
{
    private $repo;
    private $hashKey;

    public function __construct(MobileVerifyCodeRepositoryInterface $repo)
    {
        $this->repo = $repo;
        $this->hashKey = config('custom.REDIS_MOBILE_CODE_KEY');
    }

    public function getDataByMobile($phoneNumber)
    {
        // 如果redis中不存在，则请求数据库
        if (empty($detail = json_decode(Redis::hget($this->hashKey, $phoneNumber), true))) {
            $detail = $this->repo->getInfoByMobile($phoneNumber);
        }

        return $detail;
    }

    public function setData($phoneNumber, $userAgent)
    {
        $data = array();
        $data['agent'] = $userAgent;
        $data['mobile_number'] = $phoneNumber;
        $data['code'] = rand(100000, 999999);
        $data['type'] = config('custom.MOBILE_CODE_TYPE.T1');
        $data['add_time'] = date('Y-m-d H:i:s');
        $data['expire_time'] = date('Y-m-d H:i:s', strtotime($data['add_time']) + config('custom.MOBILE_CODE_EXPIRE'));

        // redis
        Redis::hset($this->hashKey, $data['mobile_number'], json_encode($data, JSON_UNESCAPED_SLASHES));
        // mysql
        $this->repo->saveData($data);
    }
}