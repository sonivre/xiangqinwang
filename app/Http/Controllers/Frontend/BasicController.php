<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;

class BasicController extends Controller
{
    public function login(Request $request)
    {
        if ($request->isMethod('get')) {
           if (View::exists('frontend.pages.login')) {
               return view('frontend.pages.login');
           }
        }

        $validateRule = array(
            'username' => 'bail|required|email',
            'password' => 'bail|required|digits_between:6,16'
        );

        $errorMessages = array(
            'username.required' => '用户名不能为空',
            'username.email' => '非有效的邮箱格式',
            'password.required' => '密码不能为空',
            'password.digits_between' => '密码必须在6-16个字符之间'
        );

        $validator = Validator::make($request->all(), $validateRule, $errorMessages);
        if ($validator->fails()) {
            // 返回并携带错误信息
            return redirect('/')->withErrors($validator)->withInput();
        }

        // 判断是否记住密码
        if (intval($request->get('remember')) == 1) {
            $request->session()->put("loginModule['remember']", 1);
        }
        $request->session()->put("loginModule['username']", $request->get('username'));
        $request->session()->put("loginModule['password']", $request->get('password'));
        var_dump($request->session()->all());
        // 待处理...
        echo 'aaa';
    }

    public function prepareRegister(Request $request)
    {
        return view('frontend.pages.register_baseinfo');
    }
}
