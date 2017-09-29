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
use App\Konohanaruto\Jobs\Frontend\MobileVerifyCode;
use App\Konohanaruto\Infrastructures\Common\ShortMessageIO\ShortMessageServiceVisitor;

class UserServiceController extends BaseJsonController
{

    private $smsVisitor;

    public function __construct(ShortMessageServiceVisitor $smsVisitor)
    {
        $this->smsVisitor = $smsVisitor;
        parent::__construct();
    }

    /**
     * 发送短信
     */
    public function sendShortMessage(Request $request)
    {
        $phoneNumber = $request->get('mobile');

        if (! verifyPhoneNumber($phoneNumber)) {
            return Response::Json(array('status' => -200, 'message' => trans('message.mobile_format_invalid')));
        }

        $detail = $this->smsVisitor->getDataByMobile($phoneNumber);

        // 判断数据库的记录
        if (! empty($detail)) {
            $retryValidTime = strtotime($detail['add_time']) + config('custom.MOBILE_CODE_REFETCH_INTERVAL');
            // 是否可以重新请求验证码
            if ($retryValidTime > time()) {
                return Response::Json(array('status' => -200, 'message' => trans('message.request_frequently')));
            }
        }


        // 入队列
//        $job = (new MobileVerifyCode($data['mobile_number'], $data['code']))
//            ->onQueue(config('custom.REDIS_MOBILE_CODE_QUEUE'));
//        dispatch($job);
    }
}