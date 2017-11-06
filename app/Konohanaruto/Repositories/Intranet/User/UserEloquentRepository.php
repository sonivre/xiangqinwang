<?php

namespace App\Konohanaruto\Repositories\Intranet\User;

use App\Konohanaruto\Repositories\Intranet\EloquentRepository;
use Illuminate\Database\Eloquent\Model;

class UserEloquentRepository extends EloquentRepository implements UserRepositoryInterface
{
    
    public function getModel()
    {
        return \App\Konohanaruto\Models\Intranet\User::class;
    }
    
    /**
     * implements
     * @see \app\Konohanaruto\Repositories\Intranet\User\UserRepository::getUserInfo()
     */
    public function getUserInfo($username)
    {
        $rowObj = $this->model->where('username', $username)->first();
        if (empty($rowObj)) {
            return false;
        }
        return $this->model->where('username', $username)->first()->toArray();
    }

    /**
     * 得到用户拥有的所有权限
     *
     * @param $userId
     * @return \Illuminate\Support\Collection
     */
    public function getUserPermissions($userId)
    {
        return $this->model
            ->from('admin_user_role as a')
            ->select('a.admin_id', 'b.permission_id')
            ->join('admin_role_permission as b', 'a.role_id', '=', 'b.role_id')
            ->where('a.admin_id', $userId)
            ->groupBy(array('a.admin_id', 'b.permission_id'))
            ->get();
    }
}