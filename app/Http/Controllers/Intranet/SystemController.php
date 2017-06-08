<?php

namespace App\Http\Controllers\Intranet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        if ($request->isMethod('get')) {
            
        }
        // render页面
        return $this->_renderLoginPage();
    }
    
    private function _renderLoginPage()
    {
        return view('intranet.pages.login');
    }
}