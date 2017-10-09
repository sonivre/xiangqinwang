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

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use MemberRegisterService;

class UserServiceController extends BaseJsonController
{

    /**
     * 发送短信
     */
    public function sendShortMessage(Request $request)
    {
        $phoneNumber = $request->get('mobile');

        if (! verifyPhoneNumber($phoneNumber)) {
            return Response::Json(array('status' => -200, 'message' => trans('message.mobile_format_invalid')));
        }

        $detail = empty(MemberRegisterService::getSMSInfoByDB($phoneNumber)) ?
            MemberRegisterService::getSMSInfoByRedis($phoneNumber) :
            MemberRegisterService::getSMSInfoByDB($phoneNumber);

        // 判断是否可以重新请求验证码
        if (! empty($detail) && ! MemberRegisterService::retryVerifyCodeCheck($detail['add_time'])) {
            return Response::Json([
                'status' => -200,
                'message' => trans('message.request_frequently')
            ]);
        }

        // 发送
        $status = MemberRegisterService::sendShortMessage($phoneNumber);
        //$status = true;

        if ($status) {
            $code = MemberRegisterService::getLatestValidMobileCode($phoneNumber);
            return Response::Json([
                'status' => 200,
                'data' => ['code' => $code],
                'message' => trans('register_service.mobile_code_request_success')
            ]);
        }

        return Response::Json([
            'status' => -200,
            'message' => trans('register_service.mobile_code_request_failed')
        ]);

    }
}