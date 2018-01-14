<?php

namespace App\Konohanaruto\Repositories\Frontend\User;

use App\Konohanaruto\Repositories\Frontend\EloquentRepository;

class UserEloquentRepository extends EloquentRepository implements UserRepositoryInterface
{

    public function getModel()
    {
        return \App\Konohanaruto\Models\Frontend\User::class;
    }

    /**
     * 返回用户基本表信息
     *
     * @param $uid
     * @return \Illuminate\Database\Eloquent\Model|null|static
     */
    public function userInfo($uid)
    {
        return $this->model->where($this->model->getKeyName(), $uid)->first();
    }

    public function updateUserInfoById($uid, $data)
    {
        return $this->model
            ->where('user_id', $uid)
            ->update($data);
    }
}