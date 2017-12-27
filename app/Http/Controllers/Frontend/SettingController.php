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
            'userInfo' => ['user_id' => $userId, 'avatar' => $userAvatar]
        ]);
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
            }

            return json_encode($response, JSON_UNESCAPED_SLASHES);
        }
    }
}