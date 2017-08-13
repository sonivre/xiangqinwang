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
}