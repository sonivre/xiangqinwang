<?php

namespace App\Konohanaruto\Repositories\Frontend\MemberAlbum;

use App\Konohanaruto\Repositories\Frontend\EloquentRepository;
use SessionFront;

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

    public function checkTrendsAlbumById($userId)
    {
        return $this->model->where([['album_name', trans('register_service.trends_album')], ['user_id', $userId]])->first();
    }

    /**
     * 创建用户名为'个人动态相册'的系统相册
     *
     * @return int 相册id
     */
    public function createTrendsAlbum()
    {
        return $this->model->insertGetId([
            'album_name' => trans('register_service.trends_album'),
            'user_id' => SessionFront::getUserId(),
            'username' => SessionFront::getUsername(),
        ]);
    }
}