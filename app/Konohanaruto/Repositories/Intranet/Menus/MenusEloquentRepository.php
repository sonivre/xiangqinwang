<?php

namespace App\Konohanaruto\Repositories\Intranet\Menus;

use App\Konohanaruto\Repositories\Intranet\EloquentRepository;

class MenusEloquentRepository extends EloquentRepository implements MenusRepositoryInterface
{

    public function getModel()
    {
        return \App\Konohanaruto\Models\Intranet\Menus::class;
    }
}