<?php
/**
 * Created by PhpStorm.
 * User: konohanaruto
 * Blog: http://www.muyesanren.com
 * QQ: 1039814413
 * Wechat Number: wikitest
 * Date: 2017/8/17
 * Time: 20:04
 */

namespace App\Http\Controllers\Intranet;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Konohanaruto\Repositories\Intranet\Permission\PermissionRepositoryInterface;
use App\Konohanaruto\Repositories\Intranet\RolePermission\RolePermissionRepositoryInterface;

class MenuController extends CoreController
{
    private $userRepository;
    private $role;
    private $passwordSecure;
    private $userRole;

    public function __construct()
    {
        parent::__construct();
    }

    public function actionAdd()
    {

    }

    public function actionDelete()
    {

    }

    public function actionEdit()
    {

    }

    public function actionList()
    {

    }
}