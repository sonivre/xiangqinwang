<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

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
           'username' => 'required|email',
           'password' => 'required|digits_between:6,16'
       );
       if ($this->validate($request, $validateRule)) {
           echo 'aaa';exit;
       }
       var_dump($_POST);
    }
}
