<?php
namespace App\Konohanaruto\Models\Intranet;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    protected $table = 'admin_user_role';
    protected $primaryKey = 'id';
    public $timestamps = false;
    
    /**
     * 插入记录
     * 
     * @return boolean
     */
    public function insertData($args)
    {
        return $this->insert($args);
    }
    
    /**
     * 得到角色列表
     * 
     * @param integer $userId
     * @return mixed
     */
    public function getRolesByUserId($userId)
    {
        $roles = $this->where('admin_id', $userId)->get();
        
        if (empty($roles)) {
            return array();
        }
        
        return $roles->toArray();
    }
    
    /**
     * 删除记录， 通过给定的条件
     */
    public function deleteRowsByIdAndRoleId($args)
    {
        return $this->where('admin_id', $args['admin_id'])
        ->whereIn('role_id', $args['role_id'])
        ->delete();
    }
    
    /**
     * 删除
     *
     * @param string|int $ids 例如: 1 或者 逗号连接的1, 2 ....
     * @return boolean
     */
    public function removeDataByUserId($ids)
    {
        $ids = explode(',', $ids);
        // 删除方法返回的是受影响的行 0行则返回0
        return $this->whereIn('admin_id', $ids)->delete();
    }
}