<?php

namespace App\Konohanaruto\Repositories\Frontend\MemberTrends;

use App\Konohanaruto\Repositories\Frontend\EloquentRepository;

class MemberTrendsEloquentRepository extends EloquentRepository implements MemberTrendsRepositoryInterface
{

    public function getModel()
    {
        return \App\Konohanaruto\Models\Frontend\MemberTrends::class;
    }

    /**
     * 插入数据
     *
     * @param $data
     * @return int
     */
    public function insertData($data)
    {
        return $this->model->insertGetId($data);
    }
}