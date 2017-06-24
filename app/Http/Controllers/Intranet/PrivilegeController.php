<?php

namespace App\Http\Controllers\Intranet;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PrivilegeController extends Controller
{
    public function actionList()
    {
        return view('intranet.pages.privilege_list');
    }
    
    public function actionAdd(Request $request)
    {
        return view('intranet.pages.privilege_add');
    }
}
