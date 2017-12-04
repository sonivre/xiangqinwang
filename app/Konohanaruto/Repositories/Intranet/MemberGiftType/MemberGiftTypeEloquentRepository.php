<?php

namespace App\Konohanaruto\Repositories\Intranet\MemberGiftType;

use App\Konohanaruto\Repositories\Intranet\EloquentRepository;

class MemberGiftTypeEloquentRepository extends EloquentRepository implements MemberGiftTypeRepositoryInterface
{

    public function getModel()
    {
        return \App\Konohanaruto\Models\Intranet\MemberGiftType::class;
    }
}