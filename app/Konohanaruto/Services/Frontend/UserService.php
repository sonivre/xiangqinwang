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

    public function __construct(UserRepositoryInterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function getUserAvatar($uid)
    {
        // 从缓存中获取数据
        $userCache = array();

        if (empty($userCache)) {
            $userInfo = $this->userRepo->userInfo($uid);
        }
    }
}