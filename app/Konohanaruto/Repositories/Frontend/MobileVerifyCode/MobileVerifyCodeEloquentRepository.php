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
}