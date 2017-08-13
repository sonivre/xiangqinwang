<?php

namespace App\Konohanaruto\Repositories\Intranet\UserRole;

use App\Konohanaruto\Repositories\Intranet\EloquentRepository;
use Illuminate\Database\Eloquent\Model;

class UserRoleEloquentRepository extends EloquentRepository implements UserRoleRepositoryInterface
{

    public function getModel()
    {
        return \App\Konohanaruto\Models\Intranet\UserRole::class;
    }
}