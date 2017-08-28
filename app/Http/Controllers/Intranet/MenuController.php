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
use App\Http\Requests\Intranet\MenuUpdateFormRequest;

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

    /**
     * @get method
     */
    public function actionEdit(PermissionRepositoryInterface $permissionRepository, Request $request, $actionId)
    {
        $menuDetail = $this->menuRepository->getDetailByMenuId($actionId);
        $permissions = $permissionRepository->getPermissionTrees();
        $topMenus = $this->menuRepository->getTopMenus();
        
        // 不存在给出错误信息
        if (empty($menuDetail)) {
            throw new \Exception('页面未发现！');
        }
        
        // 移除自身
        if (! empty($topMenus)) {
            foreach ($topMenus as $key => $item) {
                if ($actionId == $item['menu_id']) {
                    unset($topMenus[$key]);
                }
            }
        }
        
        // 区分是顶级Menu 还是子集Menu
        $isRootMenu = $menuDetail['menu_parent_id'] == 0 ? 1 : 0;
        
        return view('intranet.pages.menu_edit', array(
            'menuDetail' => $menuDetail,
            'permissions' => $permissions,
            'topMenus' => $topMenus,
            'isRootMenu' => $isRootMenu
        ));
    }
    
    /**
     * @post update
     */
    public function actionUpdate(MenuUpdateFormRequest $request)
    {
        $formData = $request->all();
        
        // 顶级Menu
        if ($formData['is_root_menu'] == 1) {
            $updateStatus = $this->menuRepository->updateData(array('menu_name' => $formData['menu_name']), $formData['menu_id']);
        } else {
            $updateStatus = $this->menuRepository->updateData(array(
                'menu_name' => $formData['menu_name'],
                'menu_route' => $formData['menu_route'],
                'menu_parent_id' => $formData['menu_parent_id'],
                'permission_id' => $formData['permission_id']
            ), $formData['menu_id']);
        }
        
        if ($updateStatus) {
            if ($formData['old_menu_name'] == $formData['menu_name']) {
                $logContent = '修改了菜单"' . $formData['menu_name'] . '"';
            } else {
                $logContent = '将菜单"' . $formData['old_menu_name'] . '"更名为"' . $formData['menu_name'] . '"';
            }
            
            $this->writeAdminLog($logContent);
            
            return redirect('intranet/MenuManage/list');
        }
        
        return redirect()->back()->withInput($formData);
    }

    public function actionList()
    {
        $menuList = $this->menuRepository->getMenuList();
        $menuList = $this->menuRepository->getMenuTree($menuList);
        
        return view('intranet.pages.menu_list', array('menuList' => $menuList));
    }
}