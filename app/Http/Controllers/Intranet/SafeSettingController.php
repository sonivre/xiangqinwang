<?php

/**
* @author: konohanaruto
* @blog: http://www.muyesanren.com
* @QQ: 1039814413
* @wechat number: wikitest
* @date: 2017年9月19日
* @version:
*/

namespace App\Http\Controllers\Intranet;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SafeSettingController extends Controller
{
    public function actionDetail()
    {
        return view('intranet.pages.safe_setting_detail');
    }
}
