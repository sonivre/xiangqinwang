<?php

namespace App\Http\Controllers\Frontend;

use App\Konohanaruto\Repositories\Frontend\User\UserRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use SessionFront;

class MemberController extends BasicController
{
    private $userRepo;

    public function __construct(UserRepositoryInterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function myAccount()
    {
        $userId = SessionFront::getUserId();
        $userInfo = $this->userRepo->userInfo($userId);

        return view('frontend.pages.authed.myaccount', ['userInfo' => $userInfo]);
    }
}
