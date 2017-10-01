<?php

namespace App\Konohanaruto\Repositories\Frontend\MobileVerifyCode;

use App\Konohanaruto\Repositories\Frontend\EloquentRepository;

class MobileVerifyCodeEloquentRepository extends EloquentRepository implements MobileVerifyCodeRepositoryInterface
{

    public function getModel()
    {
        return \App\Konohanaruto\Models\Frontend\MobileVerifyCode::class;
    }

    public function getInfoByMobile($mobile)
    {
        return $this->model->where('mobile_number', $mobile)->first();
    }

    public function insertData($data)
    {
        return $this->model->insert($data);
    }

    public function updateDataByMobile($mobile, $data)
    {
        return $this->model->where('mobile_number', $mobile)->update($data);
    }

    public function replaceDataByMobile($mobile, $data)
    {
        $model = $this->getInfoByMobile($mobile);

        return empty($model['id']) ? $this->insertData($data) : $this->updateDataByMobile($mobile, $data);
    }
}