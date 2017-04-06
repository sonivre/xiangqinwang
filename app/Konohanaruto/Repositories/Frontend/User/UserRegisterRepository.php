<?php
/**
 * Created by PhpStorm.
 * User: konohanaruto
 * Date: 2017/4/6
 * Time: 19:24
 */

namespace App\Konohanaruto\Repositories\Frontend\User;
use Illuminate\Support\Facades\DB;

class UserRegisterRepository implements UserRepository
{
    /**
     * @param $userId
     * @return 用户信息
     */
    public function find($userId)
    {
        // TODO: Implement find() method.
    }

    public function getUserList()
    {
        // TODO: Implement getUserList() method.
    }

    /**
     * 验证用户是否存在
     * @param String $username
     * @return boolean true|false
     */
    public function checkUserExists($username)
    {
        $info = DB::table('xqw_user')->select('user_id')->where('username', $username)->first();
        if (! empty($info->user_id)) {
            return false;
        }
        return true;
    }
}