<?php

namespace App\Konohanaruto\Repositories\Intranet\User;

interface UserRepositoryInterface
{
    public function getUserInfo($username);
}