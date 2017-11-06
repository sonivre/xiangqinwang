<?php
/**
 * Created by PhpStorm.
 * File: SessionService.php
 * User: konohanaruto
 * Blog: http://www.muyesanren.com
 * QQ: 1039814413
 * Wechat Number: wikitest
 * Date: 11/5/2017
 * Time: 4:16 PM
 */

namespace App\Konohanaruto\Services\Intranet;

use Illuminate\Support\Facades\Session;

class SessionService extends BaseService
{
    private $session = null;

    public function __construct()
    {
        $this->session = Session::get(config('custom.intranetSessionName'));
    }

    public function getUserId()
    {
        return $this->session['admin_id'];
    }

    public function getUsername()
    {
        return $this->session['username'];
    }
}