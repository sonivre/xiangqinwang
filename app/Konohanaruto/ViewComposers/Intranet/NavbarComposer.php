<?php

namespace App\Konohanaruto\ViewComposers\Intranet;

use Illuminate\View\View;
use App\Konohanaruto\Repositories\Intranet\Menus\MenusRepositoryInterface;
use Request;

class NavbarComposer
{
    
    private $menuRepository;
    
    /**
     * Create a new composer.
     *
     * @return void
     */
    public function __construct(MenusRepositoryInterface $menuRepository)
    {
        $this->menuRepository = $menuRepository;
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
        $currentRoute = substr($requestUri, strpos($requestUri, '/') + 1);
        $menuList = $this->menuRepository->getMenuList();
        $menuList = $this->menuRepository->getMenuTree($menuList);
        //echo '<pre>';var_dump($menuList);exit;
        $view->with(array(
            'currentRoute' => $currentRoute,
            'menuList' => $menuList
        ));
    }
}