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

    }
}