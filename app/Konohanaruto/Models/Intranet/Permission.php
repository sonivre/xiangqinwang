<?php
namespace App\Konohanaruto\Models\Intranet;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table = 'admin_permissions';
    protected $primaryKey = 'permission_id';
    public $timestamps = false;
    
    public function addPermission()
    {
        
    }
    
    /**
     * 查询权限是否已存在
     */
    public function getPermissionByName($permissionData)
    {
        $permission_name_zh = $permissionData['permission_name_zh'];
        $permission_name_en = $permissionData['permission_name_en'];
        return $this->where('permission_name_zh', $permission_name_zh)
        ->orWhere('permission_name_en', $permission_name_en)
        ->first();
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
        $data = array(
            'permission_name_zh' => $args['permission_name_zh'],
            'permission_name_en' => $args['permission_name_en'],
            'parent_id' => $args['parent_id'],
        );
        $permission = static::where('permission_id', $permissionId)->first();
        
        if (empty($permission)) {
            return false;
        }
        
        foreach ($data as $attribute => $value) {
            $permission->$attribute = $value;
        }
        
        // save 方法返回boolean值， true和false
        return $permission->save();
    }
    
    /**
     * 得到详细信息
     * 
     * @param array $id 包含权限id的一个数组
     * @return mixed
     */
    public function getInfoById($id)
    {
        $permission = static::whereIn('permission_id', $id)->get();
        if (empty($permission)) {
            return false;
        }
        return $permission->toArray();
    }
    
    /**
     * 得到子分类
     */
    public function getChildrenPermissions($permission_id)
    {
        $result = static::where('parent_id', $permission_id)->first();
        if (empty($result)) {
            return false;
        }
        return $result->toArray();
    }
    
    /**
     * 删除权限
     * 
     * @param string|int $permissionSet 例如: 1 或者 逗号连接的1, 2 ....
     * @return boolean
     */
    public function removeDataById($permissionSet)
    {
        $permissionId = explode(',', $permissionSet);
        // 删除方法返回的是受影响的行 0行则返回0
        return $this->whereIn('permission_id', $permissionId)->delete();
    }
    
    /**
     * 得到所有的顶级分类
     * 
     * @param void
     * @return array 顶级权限
     */
    public function getTopPermissions()
    {
        $result = $this
        ->select('permission_id', 'permission_name_en', 'permission_name_zh')
        ->where('parent_id', 0)
        ->get();
        if (empty($result)) {
            return array();
        }
        return $result->toArray();
    }
    
    /**
     * 得到层级关系的权限树
     * 
     * @param array $permissionList
     * @return array
     */
    public function getPermissionTree($permissionList = array())
    {
        if (empty($permissionList)) {
            return array();
        }
        
        $permissionTree = array();
        foreach ($permissionList as $key => $item) {
            if ($item['parent_id'] == 0) {
                $permissionTree[$item['permission_id']] = $item;
                unset($permissionList[$key]);
            }
        }
        
        foreach ($permissionList as $item) {
            $permissionTree[$item['parent_id']]['children'][$item['permission_id']] = $item;
        }
        
        return $permissionTree;
    }
}