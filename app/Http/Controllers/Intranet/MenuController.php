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
use App\Konohanaruto\Repositories\Intranet\Menus\MenusRepositoryInterface;
use App\Konohanaruto\Repositories\Intranet\Permission\PermissionRepositoryInterface;
use App\Http\Requests\Intranet\MenuCreateFormRequest;

class MenuController extends CoreController
{
    private $menuRepository;

    public function __construct(MenusRepositoryInterface $menuRepository)
    {
        $this->menuRepository = $menuRepository;
        
        parent::__construct();
    }
    
    public function actionAdd(PermissionRepositoryInterface $permissionRepository)
    {
        $permissions = $permissionRepository->getPermissionTrees();
        $topMenus = $this->menuRepository->getTopMenus();
        
        return view('intranet.pages.menu_add', array(
            'permissions' => $permissions,
            'topMenus' => $topMenus
        ));
    }

    public function actionStoreMenu(MenuCreateFormRequest $request)
    {
        $insertStatus = $this->menuRepository->storeMenu($request->all());
        
        if ($insertStatus) {
            $logContent = "添加了{$request->get['menu_name']}后台菜单";
        } else {
            $logContent = "添加{$request->get['menu_name']}后台菜单失败";
        }
        
        $this->writeAdminLog($logContent);
        return redirect('intranet/MenuManage/list');
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
        $menuList = $this->menuRepository->getMenuTree($menuList);
        
        return view('intranet.pages.menu_list', array('menuList' => $menuList));
    }
}