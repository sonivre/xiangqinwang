<?php

namespace App\Konohanaruto\Repositories\Frontend\MemberPicture;

use App\Konohanaruto\Repositories\Frontend\EloquentRepository;
use Illuminate\Support\Facades\DB;
use SessionFront;
use Redis;
use App\Konohanaruto\Services\Frontend\FileStorageServiceInterface;
use App\Konohanaruto\Helpers\FileHelper;
use App\Konohanaruto\Services\Frontend\UserTrendsService;
use Log;

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
        $fileHelper = app(FileHelper::class);
        $userTrendsService = app(UserTrendsService::class);

        DB::beginTransaction();

        foreach ($images as $item) {
            $original = [];
            // 先插入大图
            $original['album_id'] = $albumId;
            $original['user_id'] = SessionFront::getUserId();
            $original['username'] = SessionFront::getUsername();

            $imageBase64Data = Redis::connection('frontend')->hget($cacheKey, $item['lgKey']);
            $fileExtension = $fileHelper->detectImageExtensionFromBase64($imageBase64Data);
            $uploadDir = $userTrendsService->getTrendsTempFileUploadDir();
            $saveName = uniqid() . '.' . $fileExtension;

            // 需修改脚本，支持base64上传
            $uploadParams = array(
                'file' => array(
                    'base64' => $imageBase64Data,
                    'save_name' => $saveName
                ),
                'upload_dir' => $uploadDir
            );

            $uploadResponse = $fileStorage->uploadFile($uploadParams);
            $parsedResponse = json_decode($uploadResponse, true);

            // 上传失败的时候记录日志
            if ($parsedResponse['status'] == -200) {
                Log::error('发布动态附图上传失败！');

                return $uploadResponse;
            }

            $original['file_path'] = $parsedResponse['img_url'];
            $parentId = $this->insertData($original);
            $imageIds[] = $parentId;

            // 插入缩略图
            $original = [];
            $original['album_id'] = $albumId;
            $original['parent_id'] = $parentId;
            $original['user_id'] = SessionFront::getUserId();
            $original['username'] = SessionFront::getUsername();

            $imageBase64Data = Redis::connection('frontend')->hget($cacheKey, $item['smKey']);
            $fileExtension = $fileHelper->detectImageExtensionFromBase64($imageBase64Data);
            $uploadDir = $userTrendsService->getTrendsTempFileUploadDir();
            $saveName = uniqid() . mt_rand(5, 15) . '.' . $fileExtension;

            // 需修改脚本，支持base64上传
            $uploadParams = array(
                'file' => array(
                    'base64' => $imageBase64Data,
                    'save_name' => $saveName
                ),
                'upload_dir' => $uploadDir
            );

            $uploadResponse = $fileStorage->uploadFile($uploadParams);
            $parsedResponse = json_decode($uploadResponse, true);
            $original['file_path'] = $parsedResponse['img_url'];
            $this->insertData($original);
        }

        DB::commit();

        return $imageIds;
    }
}