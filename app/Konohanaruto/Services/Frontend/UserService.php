<?php
/**
 * Created by PhpStorm.
 * File: UserService.php
 * User: konohanaruto
 * Blog: http://www.muyesanren.com
 * QQ: 1039814413
 * Wechat Number: wikitest
 * Date: 12/24/2017
 * Time: 11:09 PM
 */

namespace App\Konohanaruto\Services\Frontend;

use App\Konohanaruto\Repositories\Frontend\User\UserRepositoryInterface;
use SessionFront;
use File;
use Illuminate\Support\Facades\Redis;
use Intervention\Image\Facades\Image;
use App\Konohanaruto\Services\Frontend\FileStorageServiceInterface;

class UserService extends BaseService
{
    use \App\Konohanaruto\Traits\Intranet\FileStorage;

    private $userRepo;
    private $fileStorage;

    public function __construct(
        UserRepositoryInterface $userRepo,
        FileStorageServiceInterface $fileStorage
    )
    {
        $this->userRepo = $userRepo;
        $this->fileStorage = $fileStorage;
    }

    public function getUserAvatar($uid)
    {
        // 从缓存中获取数据
        $userCache = array();

        if (empty($userCache)) {
            $userInfo = $this->userRepo->userInfo($uid);
            $userAvatar = $this->fileStorage->getServiceHost() . '/' . $userInfo['thumb_avatar'];

            return $userAvatar;
        }
    }

    public function uploadAvatar($file)
    {
        $userId = SessionFront::getUserId();
        $uploadDir = 'uploads/frontend/avatars/' . $userId . '/' . date('Y-m-d');
        //$uploadDir = 'uploads/frontend/avatars/' . date('Y-m-d');
        $extension = '.' . File::extension($file->getClientOriginalName());
        $savedName = uniqid() . $extension;
        $stream = curl_file_create($file->getPathname(), $file->getClientMimeType(), $savedName);

        $uploadParams = array('file' => $stream, 'upload_dir' => $uploadDir);
        //$response = json_decode($this->fileStorage->uploadFile($uploadParams), true);

        return $this->fileStorage->uploadFile($uploadParams);
    }

    public function setUserBaseData($data)
    {
        $prefix = 'frontend:user:base:info:';
        $userId = SessionFront::getUserId();
        $cacheKey = $prefix . $userId;

        // 设置数据
        Redis::connection('frontend')->hmset($cacheKey, $data);
        // 60秒过期
        Redis::connection('frontend')->expire($cacheKey, 60);

        return true;
    }

    /**
     * 更新用户头像到数据库
     *
     * @return mixed
     */
    public function updateUserInfoToDb($info)
    {
        // 得到缩略图路径
        $thumbFileName = $this->getThumbImage($info);

        if (empty($thumbFileName)) {
            return false;
        }

        $formData = json_decode($info['avatar_image_info'], true);
        // original
        $originalBigAvatar = $formData['img_url'];
        $cropAvatar = $thumbFileName;

        $updateData = array();
        $updateData['thumb_avatar'] = $thumbFileName;
        $updateData['avatar'] = $originalBigAvatar;
        $updateData['avatar_verify_status'] = -1; // 审核中
        $userInfo = $this->userRepo->userInfo(SessionFront::getUserId());
        $status = $this->userRepo->updateUserInfoById(SessionFront::getUserId(), $updateData);
        // 删除原始的用户图片
        $this->safeRemoveFile(array($userInfo['avatar'], $userInfo['thumb_avatar']));

        return $status;
    }

    /**
     * 得到图片缩略图路径
     *
     * @param $info
     * @return mixed 成功时返回图片路径，失败时返回false
     */
    public function getThumbImage($info)
    {
        $userId = SessionFront::getUserId();
        $formCrop = json_decode($info['avatar_image_info'], true);
        $cropInfo = array();

        $imagePath = $formCrop['img_host'] . '/' . $formCrop['img_url'];
        $cropInfo['width'] = $formCrop['cropWidth'];
        $cropInfo['height'] = $formCrop['cropHeight'];
        $cropInfo['x'] = $formCrop['cropX'];
        $cropInfo['y'] = $formCrop['cropY'];
        $thumbLocalTempFileName = $this->cropUserPortrait($imagePath, $cropInfo);

        if (! $thumbLocalTempFileName) {
            return false;
        }

        // 上传到指定存储服务
        $imageInfo = getimagesize($thumbLocalTempFileName);
        $extension = '.' . pathinfo($thumbLocalTempFileName, PATHINFO_EXTENSION);
        $mimeType = image_type_to_mime_type($imageInfo[2]);
        $savedName = uniqid() . $extension;
        $stream = curl_file_create($thumbLocalTempFileName, $mimeType, $savedName);
        $uploadDir = $uploadDir = 'uploads/frontend/avatars/' . $userId . '/' . date('Y-m-d');

        $uploadParams = array('file' => $stream, 'upload_dir' => $uploadDir);
        //$response = json_decode($this->fileStorage->uploadFile($uploadParams), true);

        $result = $this->fileStorage->uploadFile($uploadParams);

        if (! $result) {
            return false;
        }

        // 解析服务端响应，得到最终的图片路径
        $result = json_decode($result, true);
        $thumbFileName = $result['img_url'];
        // 删除临时文件
        @unlink($thumbLocalTempFileName);

        return $thumbFileName;
    }

    /**
     * 裁剪图片，保存到临时缓存目录，并返回该临时图片地址
     *
     * @param $imagePath
     * @param $cropInfo
     * @return bool
     */
    public function cropUserPortrait($imagePath, $cropInfo)
    {
        $storageDir = $this->getImageCachePath();
        $extension = pathinfo($imagePath, PATHINFO_EXTENSION);
        $saveFileName = $storageDir . '/' . uniqid() . '.' . $extension;

        // 不存在则尝试去创建目录
        if (! is_dir(dirname($saveFileName))) {
            mkdir(dirname($saveFileName), 0777, true);
        }

        $result = Image::make($imagePath)
            ->crop($cropInfo['width'], $cropInfo['height'], $cropInfo['x'], $cropInfo['y'])
            ->save($saveFileName);

        return $result ? $saveFileName : false;
    }

    /**
     * 返回图片缓存目录
     *
     * @return string
     */
    public function getImageCachePath()
    {
        if (! empty($this->cropImageCachePath)) {
            return $this->cropImageCachePath;
        }

        return storage_path('framework/cache/image/' . date('Y-m-d'));
    }

    /**
     * 从缓存中得到用户基本信息
     */
//    public function getUserBaseInfoById($userId)
//    {
//        // 查看redis中是否存在
//        $cacheKey = 'frontend:user:base:info:' . SessionFront::getUserId();
//        $cacheResult = Redis::connection('frontend')->hgetall($cacheKey);
//    }

    public function getUserPortraitById($userId)
    {
        // 查看redis中是否存在
        $cacheKey = 'frontend:user:base:info:' . SessionFront::getUserId();
        $userAvatar = Redis::connection('frontend')->hmget($cacheKey, ['thumb_avatar', 'avatar']);

        if (! empty($userAvatar[0]) && ! empty($userAvatar[1])) {
            return ['thumb_avatar' => $userAvatar[0], 'avatar' => $userAvatar[1]];
        }

        // 读取数据库
        $userInfo = $this->userRepo->userInfo(SessionFront::getUserId());

        if (empty($userInfo)) {
            return [];
        }

        $userPortrait = ['thumb_avatar' => $userInfo['thumb_avatar'], 'avatar' => $userInfo['avatar']];
        // 设置用户信息到redis
        $this->setUserBaseData($userPortrait);

        return $userPortrait;
    }
}