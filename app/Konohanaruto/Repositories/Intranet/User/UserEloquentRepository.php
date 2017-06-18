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
}