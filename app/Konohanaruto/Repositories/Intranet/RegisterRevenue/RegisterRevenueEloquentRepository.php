<?php

namespace App\Konohanaruto\Repositories\Intranet\RegisterRevenue;

use App\Konohanaruto\Repositories\Intranet\EloquentRepository;

class RegisterRevenueEloquentRepository extends EloquentRepository implements RegisterRevenueRepositoryInterface
{

    public function getModel()
    {
        return \App\Konohanaruto\Models\Intranet\RegisterRevenue::class;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getList()
    {
        return $this->model->get();
    }

    /**
     * @param $data
     * @return bool
     */
    public function storeData($data)
    {
        return $this->model->insert(array('revenue' => $data['revenue']));
    }

    /**
     * 得到详情
     *
     * @param $actionId
     * @return \Illuminate\Database\Eloquent\Model|null|static
     */
    public function getDetailById($actionId)
    {
        return $this->model->where($this->model->getKeyName(), $actionId)->first();
    }

    /**
     * 更新
     *
     * @param $data
     * @return bool
     */
    public function updateData($data)
    {
        return $this->model
            ->where($this->model->getKeyName(), $data['action_id'])
            ->update(array('revenue' => $data['revenue']));
    }

    /**
     * 根据id数组进行检索
     *
     * @param array $ids
     * @return \Illuminate\Support\Collection
     */
    public function getListByIds(array $ids)
    {
        return $this->model
            ->whereIn($this->model->getKeyName(), $ids)
            ->get();
    }

    public function removeDataByIds($ids)
    {
        return $this->model
            ->whereIn($this->model->getKeyName(), $ids)
            ->delete();
    }
}