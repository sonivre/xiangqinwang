<?php
/**
 * Created by PhpStorm.
 * User: konohanaruto
 * Blog: http://www.muyesanren.com
 * QQ: 1039814413
 * Wechat Number: wikitest
 * Date: 2017/10/16
 * Time: 20:27
 */

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;

class MemberRecommendController extends BasicController
{
    public function actionHome()
    {
        return view('frontend.pages.authed.home');
    }
}