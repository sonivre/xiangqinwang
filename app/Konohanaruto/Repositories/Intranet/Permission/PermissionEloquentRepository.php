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
}