<?php
/**
 * Created by PhpStorm.
 * User: konohanaruto
 * Blog: http://www.muyesanren.com
 * QQ: 1039814413
 * Wechat Number: wikitest
 * Date: 2017/9/30
 * Time: 9:27
 */

namespace App\Konohanaruto\Services\Frontend;
use UserUniversalData;
use Redis;
use App\Konohanaruto\Repositories\Frontend\MobileVerifyCode\MobileVerifyCodeRepositoryInterface;
use Log;
use App\Konohanaruto\Jobs\Frontend\MobileVerifyCode;

class MemberRegisterService extends BaseService
{

    /**
     * @param $mobile
     * @return mixed
     */
    public function getSMSInfoByDB($mobile)
    {
        $mobileRepo = app(MobileVerifyCodeRepositoryInterface::class);
        return $mobileRepo->getInfoByMobile($mobile);
    }

    /**
     * @param $mobile
     * @return mixed
     */
    public function getSMSInfoByRedis($mobile)
    {
        $hashKey = config('custom.REDIS_MOBILE_CODE_KEY');
        return json_decode(Redis::hget($hashKey, $mobile), true);
    }

    /**
     * 验证是否可以重新请求手机验证码
     *
     * @param $sendDateTime
     * @return bool
     */
    public function retryVerifyCodeCheck($sendDateTime)
    {
        $retryValidTime = strtotime($sendDateTime) + config('custom.MOBILE_CODE_REFETCH_INTERVAL');
        return ($retryValidTime > time()) ? false : true;
    }

    /**
     * 发送短信验证码
     *
     * @param $mobile
     * @return bool
     */
    public function sendShortMessage($mobile)
    {
        $hashKey = config('custom.REDIS_MOBILE_CODE_KEY');

        $data = array();
        $data['agent'] = UserUniversalData::getUserAgent();
        $data['mobile_number'] = $mobile;
        $data['code'] = UserUniversalData::getMobileVerifyCode();
        $data['type'] = config('custom.MOBILE_CODE_TYPE.T1');
        $data['add_time'] = date('Y-m-d H:i:s');
        $data['expire_time'] = date('Y-m-d H:i:s', strtotime($data['add_time']) + config('custom.MOBILE_CODE_EXPIRE'));

        // redis
        // 关于hset的返回值，新插入成功将是1，更新为0，失败为false
        $status = Redis::hset($hashKey, $data['mobile_number'], json_encode($data, JSON_UNESCAPED_SLASHES));

        if ($status === false) {
            Log::warning(trans('register_service.mobile_code_redis_failed'));
            return false;
        }

        // mysql
        $mobileRepo = app(MobileVerifyCodeRepositoryInterface::class);
        $status = $mobileRepo->replaceDataByMobile($mobile, $data);

        if (! $status) {
            Log::warning(trans('mobile_code_db_failed'));
        }

        // 队列操作
        $job = (new MobileVerifyCode($data['mobile_number'], $data['code']))
            ->onQueue(config('custom.REDIS_MOBILE_CODE_QUEUE'));
        dispatch($job);

        // 记录队列操作
        Log::info(trans('register_service.mobile_code_queue_running'));

        return true;
    }


    public function getLatestValidMobileCode($mobile)
    {
        // redis
        $hashKey = config('custom.REDIS_MOBILE_CODE_KEY');
        $data = Redis::hget($hashKey, $mobile);
        if (empty($data['code'])) {
            // mysql
            $mobileRepo = app(MobileVerifyCodeRepositoryInterface::class);
            $data = $mobileRepo->getInfoByMobile($mobile);
        }

        if (empty($data['code'])) {
            return false;
        }

        return $data['code'];
    }
}