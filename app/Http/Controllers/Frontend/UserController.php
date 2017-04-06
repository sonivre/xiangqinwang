<?php
/**
 * Created by PhpStorm.
 * User: konohanaruto
 * Date: 2017/4/6
 * Time: 19:45
 */

namespace App\Http\Controllers\Frontend;

use App\Konohanaruto\Repositories\Frontend\User\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;

class UserController extends BasicController
{

    private $registerRepo;

    public function __construct(UserRepository $userRegister)
    {
        $this->registerRepo = $userRegister;
    }

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
        // var_dump($request->session()->all());
        return redirect('register_step_one');
    }

    public function prepareRegister(Request $request)
    {
        if ($request->isMethod('post')) {
            echo 'coming soon!';exit;
        }
        return view('frontend.pages.register_baseinfo');
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
}