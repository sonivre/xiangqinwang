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
use App\Http\Requests\Frontend\UserRegisterFormRequest;
use App\Konohanaruto\Infrastructures\Frontend\SystemConfig;

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
     * 注册的最终页面
     * 
     * @param Request $request
     */
    public function finalRegister(Request $request)
    {
        if ($request->ajax()) {
            $file = $request->file('avatar');
            if (empty($file)) {
                return response()->json(array('status' => '-200'));
            }
            $path = 'avatar/' . date('Ymd');
            //file_put_contents('kk.txt', json_encode($_FILES));
            $imagePath = $file->store($path, 'uploads');
            if (! empty($imagePath)) {
                $fullPath = config('custom.staticServer') . '/uploads/' . $imagePath;
                return response()->json(array(
                    'msg' => array(
                        'src' => $fullPath,
                        'relationPath' => $imagePath
                    )
                ));
            }
            return response()->json(array('status' => '-200'));
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

    /**
     * 用户注册
     *
     * @request POST
     */
    public function actionRegister(UserRegisterFormRequest $request)
    {
        var_dump($request->all());
    }
}