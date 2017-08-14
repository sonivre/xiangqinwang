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
}