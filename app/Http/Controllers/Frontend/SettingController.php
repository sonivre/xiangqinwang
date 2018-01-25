<?php
/**
 * Created by PhpStorm.
 * File: SettingController.php
 * User: konohanaruto
 * Blog: http://www.muyesanren.com
 * QQ: 1039814413
 * Wechat Number: wikitest
 * Date: 12/24/2017
 * Time: 7:28 PM
 */

namespace App\Http\Controllers\Frontend;

use App\Http\Requests\Frontend\AvatarUploadFormRequest;
use App\Konohanaruto\Services\Frontend\SessionService;
use App\Konohanaruto\Services\Frontend\UserService;
use Illuminate\Http\Request;
use SessionFront;
use App\Http\Requests\Frontend\AvatarCropFormRequest;
use Redis;

class SettingController extends BasicController
{
    private $userService;
    private $sessionService;

    public function __construct(UserService $userService, SessionService $sessionService)
    {
        $this->userService = $userService;
        $this->sessionService = $sessionService;
    }

    public function avatarEdit()
    {
        $userId = SessionFront::getUserId();
        $userAvatar = $this->userService->getUserAvatar($userId);

        return view('frontend.pages.authed.setting_avatar', [
            'userInfo' => ['user_id' => $userId, 'thumb_avatar' => $userAvatar]
        ]);
    }

    public function updateUserAvatar(AvatarCropFormRequest $request)
    {
        $result = $this->userService->updateUserInfoToDb($request->all());

        // 写入个人动态
        $status = $this->userService->addMemberTrends();
        var_dump($status);exit;
        //写入用户动态表
        /********!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!******************/
        // 使用with保存在session, blade中使用session访问
        return redirect('home');
    }

    /**
     * ajax 上传用户头像
     */
    public function uploadAvatar(AvatarUploadFormRequest $request)
    {
        if ($request->isMethod('post')) {
            $res = $this->userService->uploadAvatar($request->file('avatar_file'));
            $response = json_decode($res, true);

            if (! empty($response['img_url'])) {
                $response['img_host'] = config('custom.staticServer');

                // 保存用户基本信息到redis临时数据媒介
                //$this->userService->setUserBaseData(array('tmp_portrait_original' => $response['img_url']));
            }

            return json_encode($response, JSON_UNESCAPED_SLASHES);
        }
    }
}