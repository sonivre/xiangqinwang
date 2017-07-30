<?php

namespace App\Konohanaruto\Repositories\Intranet\Role;

use App\Konohanaruto\Repositories\Intranet\EloquentRepository;
use Illuminate\Database\Eloquent\Model;

class RoleEloquentRepository extends EloquentRepository implements RoleRepositoryInterface
{

    public function getModel()
    {
        return \App\Konohanaruto\Models\Intranet\Role::class;
    }
}