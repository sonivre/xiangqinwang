<?php

namespace App\Konohanaruto\ViewComposers\Intranet;

use Illuminate\View\View;

class NavbarComposer
{
    
    /**
     * Create a new composer.
     *
     * @return void
     */
    public function __construct()
    {
        
    }
    
    /**
     * 被指定分配数据到blade中的方法
     * 
     * @param View $view
     * @return void
     */
    public function leftNavbar(View $view)
    {
        $view->with('count', '1111');
    }
}