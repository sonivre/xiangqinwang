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

class UserService extends BaseService
{
    private $userRepo;
    private $fileStorage;

    public function __construct(UserRepositoryInterface $userRepo, FileStorageServiceInterface $fileStorage)
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
            $userAvatar = $this->fileStorage->getServiceHost() . '/' . $userInfo['avatar'];

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

        if (! empty($response['img_url'])) {

        }
    }
}