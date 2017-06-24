<?php
namespace App\Konohanaruto\Models\Intranet;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table = 'permissions';
    public $timestamps = false;
    
    public function addPermission()
    {
        
    }
    
    /**
     * 查询权限是否已存在
     */
    public function getPermissionByName($permissionName)
    {
        return $this->where('permission_name', $permissionName)->first();
    }
    
    /**
     * 插入记录
     */
    public function savePermissionData($data)
    {
        foreach ($data as $attribute => $value) {
            $this->$attribute = $value;
        }
        return $this->save();
    }
}