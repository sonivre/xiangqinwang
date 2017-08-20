<?php
/**
 * Created by ZendStudio 12.5.1.
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
use App\Konohanaruto\Repositories\Intranet\Menus\MenusRepositoryInterface;

class MenuController extends CoreController
{
    private $menuRepository;

    public function __construct(MenusRepositoryInterface $menuRepository)
    {
        $this->menuRepository = $menuRepository;
        
        parent::__construct();
    }

    public function actionAdd()
    {
        return view('intranet.pages.menu_add');
    }

    public function actionDelete()
    {

    }

    public function actionEdit()
    {

    }

    public function actionList()
    {
        $menuList = $this->menuRepository->getMenuList();
        return view('intranet.pages.menu_list', array('menuList' => $menuList));
    }
}