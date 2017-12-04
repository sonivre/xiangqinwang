<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MemberController extends BasicController
{
    public function myAccount()
    {
        return view('frontend.pages.authed.myaccount');
    }
}
