<?php

namespace App\Http\Controllers\Intranet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function home()
    {
        echo 'aaa';
    }
    
    /**
     * 登录
     */
    public function login()
    {
        echo 'login page.';
    }
}