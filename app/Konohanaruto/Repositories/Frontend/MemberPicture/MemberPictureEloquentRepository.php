<?php

namespace App\Konohanaruto\Repositories\Frontend\MemberPicture;

use App\Konohanaruto\Repositories\Frontend\EloquentRepository;
use Illuminate\Support\Facades\DB;
use SessionFront;
use Redis;
use App\Konohanaruto\Services\Intranet\FileStorageServiceInterface;

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

    public function storePublicTrendsImage($images, $albumId)
    {
        $imageIds = [];
        $cacheKey = 'frontend:user:base64uploadtempfile';
        $fileStorage = app(FileStorageServiceInterface::class);

//        DB::transaction(function () use ($imageIds){
        DB::beginTransaction();
        foreach ($images as $item) {
            $original = [];
            // 先插入大图
            $original['album_id'] = $albumId;
            $original['user_id'] = SessionFront::getUserId();
            $original['username'] = SessionFront::getUsername();
            $original['file_path'] = $item['lgKey'];

            $imageBase64Data = Redis::connection('frontend')->hget($cacheKey, $item['lgKey']);
            $fileObject = finfo_open();
            $mime_type = finfo_buffer($fileObject, $imageBase64Data, FILEINFO_MIME_TYPE);
            $uploadDir = 'uploads/frontend/trends/' . SessionFront::getUserId() . '/' . date('Y-m-d');
            $savedName = uniqid() . '.png';
            $stream = curl_file_create($imageBase64Data, 'image/png', $savedName);

            // 需修改脚本，支持base64上传
            $uploadParams = array('file' => $stream, 'upload_dir' => $uploadDir);
            return $fileStorage->uploadFile($uploadParams);
            //$response = json_decode($this->fileStorage->uploadFile($uploadParams), true);

            $parentId = $this->insertData($original);
            $imageIds[] = $parentId;

            // 插入缩略图
            $original = [];
            $original['album_id'] = $albumId;
            $original['parent_id'] = $parentId;
            $original['user_id'] = SessionFront::getUserId();
            $original['username'] = SessionFront::getUsername();
            $original['file_path'] = $item['smKey'];
            $parentId = $this->insertData($original);
        }
        DB::commit();
//        });

        return $imageIds;
    }
}