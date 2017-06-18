<?php

namespace App\Http\Controllers\Intranet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class SystemController extends Controller
{
    public function home()
    {
        echo 'aaa';
    }
    
    /**
     * 登录
     */
    public function login(Request $request)
    {
        
        if ($request->isMethod('post')) {
            $formInfo = $request->get('info');
            $validator = Validator::make($formInfo, [
                'username' => 'required',
                'password' => 'required',
                'captcha'  => 'required|captcha',
            ], array(
                'require' => ':attribute不能为空',
                'captcha' => '验证码填写不正确',
            ));
            // view中的errors是一个索引数组，无任何对应关系，类似如下：
            // array(2) { [0]=> string(21) "邮箱格式不正确" [1]=> string(24) "验证码填写不正确" }
            if ($validator->fails()) {
                return redirect('intranet/login')
                ->withErrors($validator)
                ->withInput($formInfo);
            }
            
            // 验证成功
            var_dump($formInfo);exit;
        }
        // render页面
        return $this->_renderLoginPage();
    }
    
    private function _renderLoginPage()
    {
        return view('intranet.pages.login');
    }
    
//     // 验证码
//     public function refreshCaptcha()
//     {
        
//     }
}