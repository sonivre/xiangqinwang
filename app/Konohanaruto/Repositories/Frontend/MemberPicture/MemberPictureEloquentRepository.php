<?php

namespace App\Konohanaruto\Repositories\Frontend\MemberPicture;

use App\Konohanaruto\Repositories\Frontend\EloquentRepository;

class MemberPictureEloquentRepository extends EloquentRepository implements MemberPictureRepositoryInterface
{

    public function getModel()
    {
        return \App\Konohanaruto\Models\Frontend\MemberPicture::class;
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