<?php

namespace App\Konohanaruto\ViewComposers\Intranet;

use App\Konohanaruto\Repositories\Intranet\User\UserRepositoryInterface;
use Illuminate\View\View;
use App\Konohanaruto\Repositories\Intranet\Menus\MenusRepositoryInterface;
use Request;
use SessionService;

class NavbarComposer
{
    
    private $menuRepository;
    private $userRepository;
    
    /**
     * Create a new composer.
     *
     * @return void
     */
    public function __construct(MenusRepositoryInterface $menuRepository, UserRepositoryInterface $userRepository)
    {
        $this->menuRepository = $menuRepository;
        $this->userRepository = $userRepository;
    }
    
    /**
     * 被指定分配数据到blade中的方法
     * 
     * @param View $view
     * @return void
     */
    public function leftNavbar(View $view)
    {
        $requestUri = Request::path();

        if (strpos($requestUri, '/') === false) {
            $defaultMenuRoute = $this->getDefaultMenuRoute();
            $currentRoute = $defaultMenuRoute['currentRoute'];
            $parentMenuId = $defaultMenuRoute['parentMenuId'];
        } else {
            // 判断路由是否存在于menu表中，不存在则取session
            $currentRoute = substr($requestUri, strpos($requestUri, '/') + 1);
            $routeStatus = $this->menuRepository->getMenuInfoByRoute($currentRoute);
            $sessionData = session(config('custom.intranetSessionName') . '.selectedMenuRoute');

            if (! empty($routeStatus)) {
                $parentMenuDetail = $this->menuRepository->getParentMenuIdByRoute($currentRoute);
                $parentMenuId = $parentMenuDetail['menu_id'];
            } elseif (! empty($sessionData)) {
                $currentRoute = $sessionData['currentRoute'];
                $parentMenuId = $sessionData['parentMenuId'];
            } else {
                $defaultMenuRoute = $this->getDefaultMenuRoute();
                $currentRoute = $defaultMenuRoute['currentRoute'];
                $parentMenuId = $defaultMenuRoute['parentMenuId'];
            }
        }

        // 将默认的menu和被选中的route写入session
        session(array(config('custom.intranetSessionName') . '.selectedMenuRoute' => array(
            'currentRoute' => $currentRoute,
            'parentMenuId' => $parentMenuId
        )));

        $menuList = $this->menuRepository->getMenuList();
        $menuList = $this->menuRepository->getMenuTree($menuList);
        $menuList = $this->filterInvalidMenu($menuList);
        $result = $this->userRepository->getUserPermissions(SessionService::getUserId());
        $permissions = [];

        foreach ($result as $item) {
            $permissions[] = $item['permission_id'];
        }

        $view->with(array(
            'currentRoute' => $currentRoute,
            'menuList' => $menuList,
            'parentMenuId' => $parentMenuId,
            'permissions' => $permissions,
        ));
    }

    protected function filterInvalidMenu($menuList)
    {
        foreach ($menuList as $index => $item) {
            if (empty($item['children'])) {
                unset($menuList[$index]);
            }
        }

        return $menuList;
    }

    public function getDefaultMenuRoute()
    {
        $currentRoute = '';
        $parentMenuId = 0;
        $firstParentMenu = $this->menuRepository->getFirstParentMenu();

        if (isset($firstParentMenu['menu_id'])) {
            $parentMenuId = $firstParentMenu['menu_id'];
            $defaultRoute = $this->menuRepository->getFirstChildrenRouteByParentMenuId($firstParentMenu['menu_id']);
            $currentRoute = $defaultRoute['menu_route'];
        }

        return array('currentRoute' => $currentRoute, 'parentMenuId' => $parentMenuId);
    }
}