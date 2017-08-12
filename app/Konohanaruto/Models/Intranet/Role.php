<?php
namespace App\Konohanaruto\Models\Intranet;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'admin_roles';
    protected $primaryKey = 'role_id';
    public $timestamps = false;
    
    public function addRole($formData = array())
    {
        if (empty($roleName = $formData['role_name'])) {
            return false;
        }
        
        $this->action_user_id = $formData['user_id'];
        $this->role_name = $formData['role_name'];
        $this->create_time = date('Y-m-d H:i:s');
        $this->update_time = date('Y-m-d H:i:s');
        $status = $this->save();
        
        if ($status) {
            return $this->role_id;
        }
        
        return false;
    }
    
    /**
     * 得到角色列表
     * 
     * @return array
     */
    public function getRoleList()
    {
        $result = $this->from($this->getTable() . ' as a')
        ->select('a.*', 'b.admin_id', 'b.username')
        ->join('admin as b', 'a.action_user_id', '=', 'b.admin_id')->get();
        
        if (empty($result)) {
            return array();
        }
        
        return $result->toArray();
    }
    
    /**
     * 得到详细信息
     * 
     * @param array $id 需要检索的id
     * @return mixed
     */
    public function getInfoById($id)
    {
        $roles = static::whereIn('role_id', $id)->get();
        
        if (empty($roles)) {
            return false;
        }
        
        return $roles->toArray();
    }
    
    /**
     * 删除
     *
     * @param string|int $ids 例如: 1 或者 逗号连接的1, 2 ....
     * @return boolean
     */
    public function removeDataById($ids)
    {
        $ids = explode(',', $ids);
        // 删除方法返回的是受影响的行 0行则返回0
        return $this->whereIn('role_id', $ids)->delete();
    }
    
    /**
     * 更新数据
     * 
     * @param array $data
     * @return
     */
    public function updateDataByRoleId($args)
    {
        $roleId = $args['role_id'];
        $data = array(
            'role_name' => $args['role_name'],
            'update_time' => date('Y-m-d H:i:s'),
            'action_user_id' => $args['user_id']
        );
        $info = $this->where('role_id', $roleId)->first();
        
        if (empty($info)) {
            return false;
        }
        
        foreach ($data as $attribute => $value) {
            $info->$attribute = $value;
        }
        
        // save 方法返回boolean值， true和false
        return $info->save();
    }
    
    /**
     * 验证角色是否存在
     * 
     * @param string $roleName
     * @return 
     */
    public function checkFromRoleName($roleName)
    {
        $info = $this->where('role_name', $roleName)->first();
        return empty($info) ? true : false;
    }
}