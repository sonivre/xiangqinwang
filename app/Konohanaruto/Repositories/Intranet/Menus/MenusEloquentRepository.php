<?php

namespace App\Konohanaruto\Repositories\Intranet\Menus;

use App\Konohanaruto\Repositories\Intranet\EloquentRepository;

class MenusEloquentRepository extends EloquentRepository implements MenusRepositoryInterface
{

    public function getModel()
    {
        return \App\Konohanaruto\Models\Intranet\Menus::class;
    }
    
    /**
     * 得到menu list
     * 
     * @param void
     * @return multitype:
     */
    public function getMenuList()
    {
        $list = $this->getAll();
        return empty($list) ? array() : $list->toArray();
    }
}