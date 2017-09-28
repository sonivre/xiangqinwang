<?php
/**
 * Created by PhpStorm.
 * User: konohanaruto
 * Blog: http://www.muyesanren.com
 * QQ: 1039814413
 * Wechat Number: wikitest
 * Date: 2017/9/26
 * Time: 20:34
 */

namespace App\Http\Controllers\Tools\Json;

use App\Konohanaruto\Infrastructures\Common\SMS\ShortMessageServiceInterface;
use App\Konohanaruto\Repositories\Frontend\MobileVerifyCode\MobileVerifyCodeRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Redis;

class UserServiceController extends Controller
{

    private $sms;
    private $mobileRepo;

    public function __construct(ShortMessageServiceInterface $sms, MobileVerifyCodeRepositoryInterface $mobileRepo)
    {
        $this->sms = $sms;
        $this->mobileRepo = $mobileRepo;
    }

    /**
     * 发送短信
     */
    public function sendShortMessage(Request $request)
    {
        $phoneNumber = $request->get('mobile');
        $hashKey = config('custom.REDIS_MOBILE_CODE_KEY');

        if (! verifyPhoneNumber($phoneNumber)) {
            return Response::Json(array('code' => 10041, 'status' => 400, 'msg' => '手机号格式错误'));
        }

        // 如果redis中不存在，则请求数据库
        if (empty($detail = json_decode(Redis::hget($hashKey, $phoneNumber), true))) {
            $detail = $this->mobileRepo->getInfoByMobile($phoneNumber);
        }

        // 判断数据库的记录
        if (! empty($detail)) {
            $retryValidTime = strtotime($detail['add_time']) + config('custom.MOBILE_CODE_REFETCH_INTERVAL');
            // 是否可以重新请求验证码
            if ($retryValidTime > time()) {
                return Response::Json(array('code' => 10042, 'status' => 400, 'msg' => '请求过于频繁，请稍后再试'));
            }
        }

        $data = array();
        $data['agent'] = $request->header('User-Agent');
        $data['mobile_number'] = $phoneNumber;
        $data['code'] = rand(100000, 999999);
        $data['type'] = config('custom.MOBILE_CODE_TYPE.T1');
        $data['add_time'] = date('Y-m-d H:i:s');
        $data['expire_time'] = date('Y-m-d H:i:s', strtotime($data['add_time']) + config('custom.MOBILE_CODE_EXPIRE'));
        Redis::hset($hashKey, $data['mobile_number'], json_encode($data, JSON_UNESCAPED_SLASHES));
        // 入队列
        $this->sms->send($phoneNumber, array('code' => $data['code']));
    }
}