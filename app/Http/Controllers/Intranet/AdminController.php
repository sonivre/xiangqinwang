<?php

namespace App\Http\Controllers\Intranet;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Konohanaruto\Repositories\Intranet\User\UserRepositoryInterface;

class AdminController extends CoreController
{
    private $userRepository;
    
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
        parent::__construct();
    }
    
    public function actionList()
    {
        $userList = $this->userRepository->getUserList();
        return view('intranet.pages.admin_user_list', array('userList' => $userList));
    }
    
    public function actionAdd()
    {
        return view('intranet.pages.privilege_add');
    }
    
    public function actionEdit()
    {
        
    }
    
    public function actionDelete()
    {
        
    }
}
