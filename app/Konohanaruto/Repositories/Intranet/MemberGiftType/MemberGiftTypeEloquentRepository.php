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

    /**
     * 得到列表
     *
     * @return array
     */
    public function getAll()
    {
        return $this->model->get();
    }

    /**
     * 得到礼物类型信息
     *
     * @param $id
     * @return \Illuminate\Database\Eloquent\Model|null|static
     */
    public function getDetailById($id)
    {
        return $this->model->where($this->model->getKeyName(), $id)->first();
    }

    /**
     * 更新
     *
     * @param $data
     * @return bool
     */
    public function updateData($data)
    {
        $id = $data['action_id'];
        unset($data['action_id']);

        return $this->model
            ->where($this->model->getKeyName(), $id)
            ->update($data);
    }

    /**
     * 删除记录
     *
     * @param array $actionId 相关的id数组
     * @return mixed 返回受影响的行
     */
    public function removeDataByIds($ids)
    {
        return $this->model->whereIn($this->model->getKeyName(), $ids)->delete();
    }

    /**
     * 通过id返回相应列表
     *
     * @param $ids
     * @return array
     */
    public function getListByIds($ids)
    {
        $lists = $this->model->whereIn($this->model->getKeyName(), $ids)->get();

        return empty($lists) ? array() : $lists->toArray();
    }
}