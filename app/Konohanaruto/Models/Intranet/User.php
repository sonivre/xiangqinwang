<?php

namespace App\Konohanaruto\Models\Intranet;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'admin';
    protected $primaryKey = 'admin_id';
    public $timestamps = false;
    
    public function getUserList()
    {
        $result = static::get();
        if (empty($result)) {
            return array();
        }
        return $result->toArray();
    }
    
    public function updateUserInfoById($args)
    {
        $adminId = $args['admin_id'];
        $data = $args['data'];
        $user = static::where('admin_id', $adminId)->first();
        
        if (empty($user)) {
            return false;
        }
        
        $data['login_times'] = $user->login_times + 1;
        
        foreach ($data as $attribute => $value) {
            $user->$attribute = $value;
        }
        
        return $user->save();
    }
    
    /**
     * 添加用户
     */
    public function addUser($data)
    {
        $insertData = array();
        $insertData['username'] = $data['username'];
        $insertData['password'] = $data['password'];
        $insertData['salt'] = $data['salt'];
        $insertData['create_time'] = $data['create_time'];
    
        return $this->insertGetId($insertData);
    }
    
    /**
     * 得到用户信息
     * 
     * @param integer $userId
     * @return array
     */
    public function getUserInfoById($userId)
    {
        $userInfo = $this->where('admin_id', $userId)->first();
        
        if (empty($userInfo)) {
            return false;
        }
        
        return $userInfo->toArray();
    }
    
    /**
     * 更新用户信息
     * 
     * @param array $updateData
     * @return boolean
     */
    public function updateDataById($updateData)
    {
        if (! empty($updateData['admin_id']) && $adminId = $updateData['admin_id'])
            unset($updateData['admin_id']);
        
        return $this->where('admin_id', $adminId)->update($updateData);
    }
    
    /**
     * 得到详细信息
     *
     * @param array $id 需要检索的id
     * @return mixed
     */
    public function getInfoById($id)
    {
        $users = $this->whereIn('admin_id', $id)->get();
        return empty($users) ? array() : $users->toArray();
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
        return $this->whereIn('admin_id', $ids)->delete();
    }
}