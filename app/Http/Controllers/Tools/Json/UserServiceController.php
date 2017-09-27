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
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Redis;

class UserServiceController extends Controller
{

    private $sms;

    public function __construct(ShortMessageServiceInterface $sms)
    {
        $this->sms = $sms;
    }

    /**
     * 发送短信
     */
    public function sendShortMessage(Request $request)
    {
        $phoneNumber = $request->get('mobile');

        if (! verifyPhoneNumber($phoneNumber)) {
            return Response::Json(array('code' => 10041, 'status' => 400, 'msg' => '手机号格式错误'));
        }

        // 直接响应
        $hashKey = config('custom.REDIS_MOBILE_CODE_KEY');
        $detail = Redis::hget($hashKey, $phoneNumber);

        // 如果redis中不存在，则请求数据库
        if (empty($detail)) {
            Redis::hset($hashKey, $data['mobile_number'], json_encode($data, JSON_UNESCAPED_SLASHES));
        }

        $data = array();
        $data['agent'] = $request->header('User-Agent');
        $data['mobile_number'] = $phoneNumber;
        $data['code'] = rand(100000, 999999);
        $data['type'] = config('custom.MOBILE_CODE_TYPE.T1');
        $data['add_time'] = date('Y-m-d H:i:s');
        $data['expire_time'] = date('Y-m-d H:i:s', strtotime($data['add_time']) + config('custom.MOBILE_CODE_EXPIRE'));

        var_dump($detail);exit;
    }
}