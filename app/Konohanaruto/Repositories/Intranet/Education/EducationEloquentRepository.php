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
     * 插入学历
     *
     * @param $data
     * @return bool
     */
    public function storeData($data)
    {
        return $this->model->insert(array('name' => $data['name']));
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
            ->update(array('name' => $data['name']));
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