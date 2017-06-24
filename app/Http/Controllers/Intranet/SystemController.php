<?php

namespace App\Http\Controllers\Intranet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\Konohanaruto\Infrastructures\Common\PasswordSecure;
use App\Konohanaruto\Repositories\Intranet\User\UserEloquentRepository;

class SystemController extends Controller
{
    
    private $passwordSecure;
    private $userEloquent;
    
    public function __construct(UserEloquentRepository $userEloquent, PasswordSecure $passwordSecure)
    {
        $this->passwordSecure = $passwordSecure;
        $this->userEloquent = $userEloquent;
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
            $status = $this->checkUserPassword($formInfo['password'], $formInfo['username']);
            if (empty($status)) {
                $request->session()->put('intranet', array('username' => $formInfo['username']));
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
        $request->session()->forget('intranet');
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
        return ! empty(session('intranet')) ? true : false;
    }
}