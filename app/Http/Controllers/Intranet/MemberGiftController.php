<?php
/**
 * Created by PhpStorm.
 * File: MemberGiftController.php
 * User: konohanaruto
 * Blog: http://www.muyesanren.com
 * QQ: 1039814413
 * Wechat Number: wikitest
 * Date: 11/5/2017
 * Time: 5:55 PM
 */

namespace App\Http\Controllers\Intranet;

use Illuminate\Http\Request;

class MemberGiftController extends CoreController
{
    public function actionList()
    {
        return view('intranet.pages.member_gift.list');
    }

    public function actionShowAddForm()
    {
        return view('intranet.pages.member_gift.add');
    }
}