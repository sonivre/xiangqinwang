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
        $validator = Validator::make($request->all(), array(
            'username' => 'bail|required|email',
            'password' => 'bail|required|digits_between:6,16'
        ));
        if ($validator->fails()) {
            //return redirect()->back();
            // 返回上一页并返回携带错误信息
            return redirect('login')
                ->withErrors($validator)
                ->withInput();
            //return redirect()->back()->withErrors($validator, 'login');
        }

        echo '验证成功';exit;
    }
}
