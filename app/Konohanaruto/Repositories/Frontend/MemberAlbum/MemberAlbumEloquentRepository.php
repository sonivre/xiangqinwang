<?php

namespace App\Konohanaruto\Repositories\Frontend\MemberAlbum;

use App\Konohanaruto\Repositories\Frontend\EloquentRepository;

class MemberAlbumEloquentRepository extends EloquentRepository implements MemberAlbumRepositoryInterface
{

    public function getModel()
    {
        return \App\Konohanaruto\Models\Frontend\MemberAlbum::class;
    }

    public function getAvatarAlbumByUserId($userId)
    {
        return $this->model->where([['user_id', $userId], ['album_name' ,trans('register_service.avatar_album')]])->first();
    }

    /**
     * 插入新相册
     *
     * @param $data
     * @return int
     */
    public function insertData($data)
    {
        return $this->model->insertGetId($data);
    }
}