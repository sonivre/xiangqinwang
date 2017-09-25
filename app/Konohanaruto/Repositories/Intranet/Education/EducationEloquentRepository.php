<?php

namespace App\Konohanaruto\Repositories\Intranet\Education;

use App\Konohanaruto\Repositories\Intranet\EloquentRepository;

class EducationEloquentRepository extends EloquentRepository implements EducationRepositoryInterface
{

    public function getModel()
    {
        return \App\Konohanaruto\Models\Intranet\Education::class;
    }

    /**
     * 得到所有的学历列表
     *
     * @param void
     * @return mixed
     */
    public function getEducationList()
    {
        return $this->model->get();
    }

    /**
     * 插入学历
     *
     * @param $data
     * @return bool
     */
    public function storeData($data)
    {
        return $this->model->insert(array('name' => $data['name']));
    }
}