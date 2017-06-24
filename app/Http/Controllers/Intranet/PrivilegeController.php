<?php

namespace App\Http\Controllers\Intranet;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Konohanaruto\Repositories\Intranet\Permission\PermissionEloquentRepository;

class PrivilegeController extends Controller
{
    protected $permission;
    
    public function __construct(PermissionEloquentRepository $permission)
    {
        $this->permission = $permission;
    }
    
    public function actionList()
    {
        return view('intranet.pages.privilege_list');
    }
    
    public function actionAdd(Request $request)
    {
        if ($request->isMethod('POST')) {
            $userinfo = $request->session()->get('intranet');
            $permissionData = array();
            $permissionData['permission_name'] = $request->get('permission_name');
            $permissionData['admin_id'] = $userinfo['admin_id'];
            $permissionData['create_time'] = date('Y-m-d H:i:s');
            $permissionData['update_time'] = date('Y-m-d H:i:s');
            $result = $this->permission->addPermission($permissionData);
            if ($result) {
                return view('intranet.pages.privilege_list');
            }
            return view('intranet.pages.privilege_add', array(
                'errorMsg' => '添加失败！ 已存在的权限或网络错误！'
            ));
        }
        return view('intranet.pages.privilege_add');
    }
}
