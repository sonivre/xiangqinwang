<?php
/**
 * Created by PhpStorm.
 * User: konohanaruto
 * Date: 2017/4/6
 * Time: 19:14
 */

namespace App\Konohanaruto\Repositories\Frontend\User;

interface UserRepository
{
    public function find($userId);

    public function getUserList();
}
