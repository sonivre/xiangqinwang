<?php
namespace App\Konohanaruto\Models\Intranet;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table = 'permissions';
    protected $primaryKey = 'permission_id';
    public $timestamps = false;
    
    public function userAll()
    {
        return $this->belongsTo('App\Konohanaruto\Models\Intranet\User', 'admin_id', 'admin_id');
    }
    
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
    
    /**
     * 编辑
     */
    public function updatePermissionById($args)
    {
        $permissionId = $args['permission_id'];
        $data = array('permission_name' => $args['permission_name']);
        $permission = static::where('permission_id', $permissionId)->first();
        
        if (empty($permission)) {
            return false;
        }
        
        foreach ($data as $attribute => $value) {
            $permission->$attribute = $value;
        }
        
        return $permission->save();
    }
    
    /**
     * 得到详细信息
     */
    public function getInfoById($id)
    {
        $permission = static::where('permission_id', $id)->first();
        if (empty($permission)) {
            return false;
        }
        return $permission->toArray();
    }
}