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
}