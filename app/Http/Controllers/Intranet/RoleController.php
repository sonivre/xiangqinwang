<?php

namespace App\Http\Controllers\Intranet;

use Illuminate\Http\Request;
use Validator;
use App\Konohanaruto\Repositories\Intranet\Role\RoleRepositoryInterface;
use App\Konohanaruto\Repositories\Intranet\Permission\PermissionEloquentRepository;

class RoleController extends CoreController
{
    protected $role;
    protected $permissionRepository;

    public function __construct(RoleRepositoryInterface $role, PermissionEloquentRepository $permissionRepository)
    {
        $this->role = $role;
        $this->permissionRepository = $permissionRepository;
        parent::__construct();
    }
    
    public function actionList()
    {
        return view('intranet.pages.role_list');
    }
    
    public function actionAdd()
    {
        $permissions = $this->permissionRepository->getPermissionTrees();
        //var_dump($permissions);exit;
        return view('intranet.pages.role_add', array('permissions' => $permissions));
    }
}