<?php

namespace App\Http\Controllers\Intranet;
use Illuminate\Http\Request;
use Validator;
use App\Konohanaruto\Infrastructures\Common\PasswordSecure;
use App\Konohanaruto\Repositories\Intranet\User\UserRepositoryInterface;

class SystemController extends CoreController
{
    
    private $passwordSecure;
    private $userEloquent;
    
    public function __construct(UserRepositoryInterface $userEloquent, PasswordSecure $passwordSecure)
    {
        $this->passwordSecure = $passwordSecure;
        $this->userEloquent = $userEloquent;
        parent::__construct();
    }
    
    public function home(Request $request)
    {
        return view('intranet.pages.home');
    }
    
    /**
     * 登录
     */
    public function login(Request $request)
    {
        // 如果已经登录则跳转上一页
        if ($this->checkUserLoginStatus()) {
            return redirect()->back();
        }
        
        if ($request->isMethod('post')) {
            $formInfo = $request->get('info');
            $validator = $this->userValidate($formInfo);
            // view中的errors是一个索引数组，无任何对应关系，类似如下：
            // array(2) { [0]=> string(21) "邮箱格式不正确" [1]=> string(24) "验证码填写不正确" }
            if ($validator->fails()) {
                return redirect('intranet/login')
                ->withErrors($validator)
                ->withInput($formInfo);
            }
            $userinfo = $this->userEloquent->getUserInfo($formInfo['username']);
            $status = $this->checkUserPassword($formInfo['password'], $formInfo['username']);
            if (empty($status)) {
                $request->session()->put(config('custom.intranetSessionName'), array(
                    'username' => $formInfo['username'],
                    'admin_id' => $userinfo['admin_id']
                ));
                return redirect('intranet');
            }
            return view('intranet.pages.login', $status);
        }
        return view('intranet.pages.login');
    }
    
    /**
     * 注销/退出登录
     */
    public static function actionLogout(Request $request)
    {
        $request->session()->forget(config('custom.intranetSessionName'));
        return redirect('/intranet');
    }
    
    /**
     * 表单验证
     * 
     * @return Unknown
     */
    private function userValidate($formInfo)
    {
        $validator = Validator::make($formInfo, [
            'username' => 'required',
            'password' => 'required',
            'captcha'  => 'required|captcha',
        ], array(
            'require' => ':attribute不能为空',
            'captcha' => '验证码填写不正确',
        ));
        return $validator;
    }
    
    /**
     * 验证密码
     */
    private function checkUserPassword($nativePassword, $username)
    {
        $userinfo = $this->userEloquent->getUserInfo($username);
        if (empty($userinfo)) {
            return array('userAuthErrors' => '用户不存在');
        }
        $encryptPassword = $this->passwordSecure->getEncryptPassword($nativePassword, $userinfo['salt']);
        if ($encryptPassword !== $userinfo['password']) {
            return array('userAuthErrors' => '用户名或密码不正确');
        }
        return array();
    }
    
    /**
     * 验证用户是否已经登录
     */
    public function checkUserLoginStatus()
    {
        return ! empty(session(config('custom.intranetSessionName'))) ? true : false;
    }
}