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
     * @return array
     */
    public function getMenuList()
    {
        $list = $this->getAll();
        return empty($list) ? array() : $list->toArray();
    }
    
    /**
     * 得到顶级Menu
     * 
     * @param void
     * @return array
     */
    public function getTopMenus()
    {
        $menus = $this->model->where('menu_parent_id', 0)->get();
        return empty($menus) ? array() : $menus->toArray();
    }
    
    /**
     * 插入数据
     * 
     * @param array $formData
     * @return boolean
     */
    public function storeMenu($data)
    {
        $insert = array();
        
        $insert['menu_name']      = $data['menu_name'];
        // 确保为顶级Menus才允许写入该值
        $insert['menu_route']     = (empty($data['menu_route']) || $data['menu_parent_id'] ==0) ? '' : $data['menu_route'];
        $insert['permission_id']  = $data['permission_id'];
        $insert['menu_parent_id'] = $data['menu_parent_id'];
        
        return $this->model->insert($insert);
    }
    
    /**
     * 得到层级关系的Menu树
     *
     * @param array $menuList
     * @return array
     */
    public function getMenuTree($menuList = array())
    {
        if (empty($menuList)) {
            return array();
        }
    
        $menuTree = array();
        
        foreach ($menuList as $key => $item) {
            if ($item['menu_parent_id'] == 0) {
                $menuTree[$item['menu_id']] = $item;
                unset($menuList[$key]);
            }
        }
    
        foreach ($menuList as $item) {
            $menuTree[$item['menu_parent_id']]['children'][$item['menu_id']] = $item;
        }
    
        return $menuTree;
    }
}