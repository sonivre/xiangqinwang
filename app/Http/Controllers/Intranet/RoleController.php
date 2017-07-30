<?php

namespace App\Http\Controllers\Intranet;

use Illuminate\Http\Request;
use Validator;
use App\Konohanaruto\Repositories\Intranet\Role\RoleRepositoryInterface;

class RoleController extends CoreController
{
    protected $role;

    public function __construct(RoleRepositoryInterface $role)
    {
        $this->role = $role;
        parent::__construct();
    }
    
    public function actionList()
    {
        return view('intranet.pages.privilege_list');
    }
}