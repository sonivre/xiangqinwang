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
        
        // 写入管理员日志
        $this->writeAdminLog($logContent);
        return redirect('intranet/MenuManage/list');
    }

    public function actionDelete(Request $request)
    {
        if ($request->ajax()) {
            $actionId = $request->get('action_id');
            $removeIds = explode(',', $actionId);
            
            if (empty($actionId) || empty($removeIds)) {
                return response()->json(array('error' => '参数错误'));
            }
            
            $relationMenuList = $this->menuRepository->getMenuListByIds($removeIds);
            // 移除相关记录
            $affects = $this->menuRepository->removeDataByMenuIds($removeIds);
            
            // 写入管理员日志
            if ($affects) {
                foreach ($relationMenuList as $item) {
                    $this->writeAdminLog('删除了"' . $item['menu_name'] . '"菜单');
                }
            }
            
            return response()->json(array('rows' => $affects));
        }
        
        return response()->json(array('code' => 400, 'errorMsg' => '非法请求'), 404);
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