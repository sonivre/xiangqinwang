<?php
/**
 * Created by PhpStorm.
 * User: konohanaruto
 * Date: 2017/4/6
 * Time: 19:45
 */

namespace App\Http\Controllers\Frontend;

use App\Konohanaruto\Exceptions\Frontend\NotFoundException;
use App\Konohanaruto\Repositories\Frontend\User\UserRepository;
use App\Konohanaruto\Validators\EmailPasswordValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class UserController extends BasicController
{

    private $registerRepo;
    private $emailPasswordValidator;

    public function __construct(UserRepository $userRegister, EmailPasswordValidator $emailPasswordValidator)
    {
        $this->registerRepo = $userRegister;
        $this->emailPasswordValidator = $emailPasswordValidator;
    }

    public function authenticationRegisterEmail(Request $request)
    {
        if ($request->isMethod('get')) {
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
        // 得到生日的select数据
        $birthData = $this->registerRepo->getBirthSelectData();
        return view('frontend.pages.register_baseinfo', array(
            'birthData' => $birthData
        ));
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