<?php

namespace App\Konohanaruto\Repositories\Intranet\MemberGiftType;

use App\Konohanaruto\Repositories\Intranet\EloquentRepository;

class MemberGiftTypeEloquentRepository extends EloquentRepository implements MemberGiftTypeRepositoryInterface
{

    public function getModel()
    {
        return \App\Konohanaruto\Models\Intranet\MemberGiftType::class;
    }

    /**
     * 插入数据
     *
     * @return bool
     */
    public function storeGift($data)
    {
        return $this->model->insert($data);
    }
}