<?php

namespace App\Konohanaruto\Repositories\Intranet\Permission;

use App\Konohanaruto\Repositories\Intranet\EloquentRepository;
use Illuminate\Database\Eloquent\Model;

class PermissionEloquentRepository extends EloquentRepository implements PermissionRepositoryInterface
{

    public function getModel()
    {
        return \App\Konohanaruto\Models\Intranet\Permission::class;
    }
    
    /**
     * 接口实现
     * @see \App\Konohanaruto\Repositories\Intranet\Permission\PermissionRepositoryInterface::getAllPermissions()
     */
    public function getAllPermissions()
    {
        
    }
    
    /**
     * 添加权限
     * 
     * @param array $permissionData
     * @return Boolean
     */
    public function addPermission($permissionData)
    {
        $status = $this->model->getPermissionByName($permissionData);
        if (empty($status)) {
            $actionFlag = $this->model->savePermissionData($permissionData);
            if ($actionFlag) {
                return true;
            }
        }
        return false;
    }
    
    /**
     * 得到权限列表
     */
    public function getPermissionList()
    {
        // getTable 得到表名
        $result = $this->model
        ->from($this->model->getTable() . ' as a')
        ->select('a.*', 'b.admin_id', 'b.username')
        ->join('admin as b', 'a.action_user_id', '=', 'b.admin_id')->get();
        if (empty($result)) {
            return array();
        }
        return $result->toArray();
    }
    
    /**
     * 删除权限之前的验证, 验证permission层级关系, 以及完整性，是否可以删除, 子分类的验证等等
     */
    public function checkChildrenStatus($permissions = array())
    {
        if (empty($permissions)) {
            return false;
        }
        
        $permissionList = $this->getPermissionList();
        $permissionRelation = array();
        if (! empty($permissionList)) {
            foreach ($permissionList as $item) {
                if ($item['parent_id'] != 0) {
                    $permissionRelation[$item['parent_id']][] = $item['permission_id'];
                }
            }
        }
        
        $permissionClient = array();
        // 讲用户传入的permission构造成和上方数组一样的结构
        foreach ($permissions as $item) {
            if (key_exists($item, $permissionRelation)) {
                // 处理该数组
                $permissionClient[$item] = array();
                foreach ($permissionRelation[$item] as $permissionId) {
                    // 客户端传来的分类中, 存在父分类下的某一个子项, 则把它加入数组
                    if (in_array($permissionId, $permissions)) {
                        $permissionClient[$item][] = $permissionId;
                    }
                }
            }
        }
        
        // 最后，比较
        if (! empty($permissionClient)) {
            foreach ($permissionClient as $parentId => $childrens) {
                // 只要存在父分类存在子分类没有被勾选的情况，就返回false
                if ($permissionRelation[$parentId] != $childrens) {
                    return false;
                }
            }
        }
        
        return true;
    }
    
    /**
     * 构造权限树形结构
     * 
     * @param void
     * @return array 权限树
     */
    public function getPermissionTrees()
    {
        $permissionList = $this->getPermissionList();
        
        if (empty($permissionList)) {
            return $permissionList;
        }
        
        $permissions = array();
        
        // 父级分类
        foreach ($permissionList as $item) {
            if ($item['parent_id'] == 0) {
                $permissions[$item['permission_id']] = $item;
            }
        }
        
        // 子级分类
        foreach ($permissionList as $item) {
            if ($item['parent_id'] != 0) {
                $permissions[$item['parent_id']]['children'][$item['permission_id']] = $item;
            }
        }
        
        return $permissions;
    }
}