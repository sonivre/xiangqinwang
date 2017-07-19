<?php

namespace App\Http\Controllers\Intranet;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Konohanaruto\Repositories\Intranet\Permission\PermissionRepositoryInterface;

class UserRolesController extends CoreController
{
    protected $permission;
    
    public function __construct(PermissionRepositoryInterface $permission)
    {
        $this->permission = $permission;
        parent::__construct();
    }
    
    public function actionList()
    {
        $permissionList = $this->permission->getPermissionList();
        return view('intranet.pages.privilege_list', array('permissionList' => $permissionList));
    }
    
    public function actionAdd(Request $request)
    {
        if ($request->isMethod('POST')) {
            $userinfo = $request->session()->get(config('custom.intranetSessionName'));
            $permissionData = array();
            $permissionData['permission_name'] = $request->get('permission_name');
            $permissionData['admin_id'] = $userinfo['admin_id'];
            $permissionData['create_time'] = date('Y-m-d H:i:s');
            $permissionData['update_time'] = date('Y-m-d H:i:s');
            $result = $this->permission->addPermission($permissionData);
            if ($result) {
                // 写入管理员日志
                $this->writeAdminLog('添加了"' . $request->get('permission_name') . '"权限');
                return redirect('intranet/Privilege/list');
            }
            return view('intranet.pages.privilege_add', array(
                'errorMsg' => '添加失败！ 已存在的权限或网络错误！'
            ));
        }
        return view('intranet.pages.privilege_add');
    }
    
    public function actionEdit(Request $request, $permissionId = null)
    {
        if ($request->isMethod('POST')) {
            $formInfo = $request->all();
            $validator = Validator::make($formInfo, [
                'permission_id' => 'numeric',
                'permission_name' => 'required'
            ], array(
                'numeric' => ':attribute必须为数字',
                'required' => ':attribute不能为空',
            ));
            
            if ($validator->fails()) {
                return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput($formInfo);
            }
            
            $status = $this->permission->updatePermissionById($formInfo);
            
            if ($status) {
                return redirect('intranet/Privilege/list');
            }
            
            return view('intranet.pages.privilege_edit', array('errorMsg' => '操作失败！'));
        }
        
        if (empty($permissionId)) {
            return redirect()->back();
        }
        
        $permissionId = intval($permissionId);
        $info = $this->permission->getInfoById($permissionId);
        return view('intranet.pages.privilege_edit', array('info' => $info));
    }
    
    public function actionDelete(Request $request, $permissionId = null)
    {
        if ($request->ajax()) {
            $permissionId = $request->get('permission_id');
            if (empty($permissionId)) {
                return response()->json(array('error' => '您还没有选择需要删除的项'));
            }
            $affectedRows = $this->permission->removeDataById($permissionId);
            return response()->json(array('rows' => $affectedRows));
        }
    
        if (empty($permissionId)) {
            return redirect()->back();
        }
    
        $permissionId = intval($permissionId);
        $info = $this->permission->getInfoById($permissionId);
        return view('intranet.pages.privilege_edit', array('info' => $info));
    }
}
