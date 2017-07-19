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
}