<?php

namespace App\Konohanaruto\Repositories\Intranet\RolePermission;

use App\Konohanaruto\Repositories\Intranet\EloquentRepository;
use Illuminate\Database\Eloquent\Model;

class RolePermissionEloquentRepository extends EloquentRepository implements RolePermissionRepositoryInterface
{
    public function getModel()
    {
        return \App\Konohanaruto\Models\Intranet\RolePermission::class;
    }
}