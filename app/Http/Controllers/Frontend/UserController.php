<?php
/**
 * Created by PhpStorm.
 * User: konohanaruto
 * Date: 2017/4/6
 * Time: 19:45
 */

namespace App\Http\Controllers\Frontend;

use App\Konohanaruto\Exceptions\Frontend\NotFoundException;
use App\Konohanaruto\Facades\Frontend\MemberRegisterService;
use App\Konohanaruto\Repositories\Frontend\User\UserRepository;
use App\Konohanaruto\Validators\EmailPasswordValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Http\Requests\Frontend\UserRegisterFormRequest;
use App\Konohanaruto\Infrastructures\Frontend\SystemConfig;
use Illuminate\Support\Facades\Response;
use Mockery\CountValidator\Exception;
use Session;
use App\Konohanaruto\Repositories\Frontend\MemberAlbum\MemberAlbumRepositoryInterface;
use Request as RequestFacade;
use Mail;
use App\Mail\Frontend\RegisterMemberActivation;
use Swift_TransportException;
use Log;
use UserUniversalData;
use DecryptException;
use App\Http\Requests\Frontend\LoginRequest;
use App\Konohanaruto\Infrastructures\Common\PasswordSecure;
use MemberAuthService;

class UserController extends BasicController
{

    private $registerRepo;
    private $emailPasswordValidator;
    private $systemConfig;

    public function __construct(UserRepository $userRegister,
                                EmailPasswordValidator $emailPasswordValidator,
                                SystemConfig $systemConfig)
    {
        $this->registerRepo = $userRegister;
        $this->emailPasswordValidator = $emailPasswordValidator;
        $this->systemConfig = $systemConfig;
    }

    public function authenticationRegisterEmail(Request $request)
    {
        if ($request->isMethod('get')) {
            // 验证如果已经登录，就不让他显示此页面
            if (MemberAuthService::checkUserLogin()) {
                return redirect('home');
            }

            if (View::exists('frontend.pages.login')) {
                return view('frontend.pages.login');
            }
            throw new NotFoundException;
        }

        $validator = $this->emailPasswordValidator->runValidatorChecks($request->all());
        if ($validator) {
            if ($validator->fails())
                // 返回并携带错误信息
                return redirect('/')->withErrors($validator)->withInput();
            // 判断是否记住密码
            if (intval($request->get('remember')) == 1) {
                $request->session()->put("loginModule['remember']", 1);
            }
            $request->session()->put("loginModule['username']", $request->get('username'));
            $request->session()->put("loginModule['password']", $request->get('password'));
            return redirect('register_step_one');
        }

        return view('frontend.pages.login');
    }

    public function prepareRegister(Request $request)
    {
        if ($request->isMethod('post')) {
            echo 'coming soon!';exit;
        }

        $selectData = array();
        // 得到生日的select数据
        $selectData['birth'] = $this->registerRepo->getBirthSelectData();
        // 得到身高的select下拉框数据
        $selectData['height'] = $this->registerRepo->getHeightSelectData();
        // 得到学历数据
        $selectData['education'] = $this->systemConfig->userRegister->getEducationList();
        // 收入下拉框数据
        $selectData['revenue'] = $this->systemConfig->userRegister->getRevenueList();
        // 根据用户ip地址粗略得到地址
        $currentIp = $request->ip();
        $selectData['location'] = $this->registerRepo->getLocationSelectData($currentIp);
        return view('frontend.pages.register_baseinfo', array(
            'selectData' => $selectData
        ));
    }
    
    /**
     * 注册时提交头像页面
     * 
     * @param Request $request
     */
    public function actionRegisterMemberAvatar(Request $request)
    {
        if (empty($request->session()->get('register.userinfo'))) {
            return redirect()->back();
        }

        return view('frontend.pages.register_final');
    }

    public function checkUserExists(Request $request)
    {
        $username = $request->get('username');
        $response = array('valid' => false);
        if (! empty($username)) {
            if (! $this->registerRepo->checkUserExists($username)) {
                $response['valid'] = false;
            } else {
                $response['valid'] = true;
            }
        }
        return response()->json($response);
    }

    public function actionStoreMemberRegisterAvatar(Request $request)
    {
        $userId = Session::get('register.userinfo.user_id');
        $username = Session::get('register.userinfo.username');
        $avatarPath = $request->get('avatar_src');

        // 存储用户头像到数据库, 如果不存在相册，则创建默认相册
        $memberAlubmRepo = app(MemberAlbumRepositoryInterface::class);
        $album = $memberAlubmRepo->getAvatarAlbumByUserId($userId);

        // 用户没有默认相册，我们替它创建一个与业务相关联的相册
        if (empty($album)) {
            $albumId = MemberRegisterService::createMemberAlbum(trans('register_service.avatar_album'), $userId, $username);
        } else {
            $albumId = $album['album_id'];
        }

        if ($albumId <= 0) {
            throw new \Exception(trans('register_service.avatar_album_create_failed'));
        }

        // 写入session中，记录当前用户的头像相册id和头像路径
        Session::put('register.userinfo.avatar_album_id', $albumId);
        Session::put('register.userinfo.avatar_path', $avatarPath);

        MemberRegisterService::storeUserAvatar($userId, $username, $albumId, $avatarPath);
        // 跳转邮箱认证引导页面
        return redirect('User/Supports/activationEmail');
    }

    /**
     * ajax上传头像
     *
     * @param Request $request
     * @return mixed
     */
    public function actionUploadMemberAvatar(Request $request)
    {
        $response = MemberRegisterService::uploadAvatar($request);

        return Response::Json($response);
    }

    /**
     * 用户基本信息录入
     *
     * @request POST
     */
    public function actionStoreRegisterInfo(UserRegisterFormRequest $request)
    {
        // 存储用户信息
        $result = MemberRegisterService::addUser($request->all());

        if (! empty($result['status'] == 200)) {
            // 跳转到
            return redirect('User/registerMemberAvatar');
        }

        return redirect()->back()->withInput($request->all());
    }

    /**
     * 发送注册激活邮件
     */
    public function actionActivationEmail()
    {
        $userId = Session::get('register.userinfo.user_id');
        $username = Session::get('register.userinfo.username');
        $email = Session::get('register.userinfo.email');
        $currentRoute = RequestFacade::path();

        if (! $userId && ! $username) {
            return redirect()->back();
        }

        try {
            Mail::to($email)->queue((new RegisterMemberActivation($userId, $username, $email))
                ->onQueue(config('custom.REDIS_ACCOUNT_ACTIVATION_MAIL_QUEUE')));
        } catch (Swift_TransportException $e) {
            Log::error($e->getMessage());

            return redirect()->back();
        } catch (Exception $e) {
            Log::error($e->getMessage());

            return redirect()->back();
        }

        return view('frontend.pages.register_emailing', ['currentRoute' => $currentRoute]);
    }

    public function actionActivationAccount(Request $request)
    {
        $token = $request->get('code');

        try {
            $plainToken = UserUniversalData::decodeAccountMailActivationToken($token);
        } catch (DecryptException $e) {
            Log::error($e->getMessage());

            return redirect('/');
        }

        if (MemberRegisterService::checkEmailActivationToken($plainToken)) {
            // 让用户变成激活状态
            $status = MemberRegisterService::updateMemberIdentifyStatus();
        }

        // 会员一些初始化信息更新，日志，花田币等
        // ...
        return redirect('/');

    }

    public function actionLogin(LoginRequest $request)
    {
        $username = $request->get('username');
        $password = $request->get('password');
        $remember = intval($request->get('remember'));
        $userRepo = app(UserRepository::class);
        $passwordSecure = app(PasswordSecure::class);
        $userInfo = (array) $userRepo->findUser(['username' => $username]);

        if (empty($userInfo) ||
            $userInfo['password'] != $passwordSecure->getEncryptPassword($password, $userInfo['salt'])
        ) {
            return redirect()
                ->back()
                ->withInput($request->all)
                ->withErrors([trans('authentication.username_or_password_mistake')]);
        }

        // 保存用户信息到session等
        MemberAuthService::storeUserInfoToSession($userInfo);

        // 如果用户选择记住密码，保存到cookie
        if ($remember == 1) {
            return redirect('home')->withCookie(MemberAuthService::storeUserInfoToCookie($userInfo));
        }

        return redirect('home');
    }

    public function actionLogout()
    {
        MemberAuthService::flushUserSession();
        return redirect('/')->withCookie(MemberAuthService::forgetUserLoginCookie());
    }
}