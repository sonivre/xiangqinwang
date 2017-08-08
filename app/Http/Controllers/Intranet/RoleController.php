<?php

namespace App\Http\Controllers\Intranet;

use Illuminate\Http\Request;
use Validator;
use App\Konohanaruto\Repositories\Intranet\Role\RoleRepositoryInterface;
use App\Konohanaruto\Repositories\Intranet\Permission\PermissionEloquentRepository;
use App\Konohanaruto\Repositories\Intranet\RolePermission\RolePermissionEloquentRepository;

class RoleController extends CoreController
{
    protected $role;
    protected $rolePermission;
    protected $permissionRepository;

    public function __construct(RoleRepositoryInterface $role, PermissionEloquentRepository $permissionRepository, RolePermissionEloquentRepository $rolePermission)
    {
        $this->role = $role;
        $this->permissionRepository = $permissionRepository;
        $this->rolePermission = $rolePermission;
        parent::__construct();
    }
    
    public function actionList()
    {
        $roleList = $this->role->getRoleList();
        // echo '<pre>';var_dump($roleList);exit;
        return view('intranet.pages.role_list', array('roleList' => $roleList));
    }
    
    public function actionAdd(Request $request)
    {
        if ($request->isMethod('POST')) {
            $formData = array();
            $formData['role_name'] = $request->get('role_name');
            $formData['granted_permissions'] = $request->get('permission_id');
            $formData['user_id'] = $this->getCurrentUserId();
            // 角色信息入库
            $roleId = $this->role->addRole($formData);
            
            // 权限信息入库
            if ($roleId) {
                $formData['role_id'] = $roleId;
                $status = $this->rolePermission->addData($formData);
                
                if (! empty($status)) {
                    // 写入管理员日志
                    $actionLogContent = '添加了角色"' . $formData['role_name'] . '"';
                    $this->writeAdminLog($actionLogContent);
                    return redirect('intranet/RoleManage/list');
                }
            }
            
            return redirect()
            ->back()
            ->withInput($formData);
        }
        
        $permissions = $this->permissionRepository->getPermissionTrees();
        return view('intranet.pages.role_add', array('permissions' => $permissions));
    }
    
    public function actionDelete(Request $request, $actionId = null)
    {
        if ($request->ajax()) {
            $actionId = $request->get('action_id');
    
            if (empty($actionId)) {
                return response()->json(array('error' => '您还没有选择需要删除的项'));
            }
    
    
            $actionItems = explode(',', $actionId);
            // 得到被删除的信息
            $deleteItemRows = $this->role->getInfoById($actionItems);
            $affectedRows = $this->role->removeDataById($actionId);
            
            // 删除role_permission表相应记录
            if ($affectedRows) {
                $this->rolePermission->removeDataByRoleId($actionId);
            }
            // return response()->json(array('rows' => $deleteItemRows));
    
            // 更新相关删除日志
            if ($affectedRows) {
                foreach ($deleteItemRows as $info) {
                    $this->writeAdminLog('删除了"' . $info['role_name'] . '"角色');
                }
            }
    
            return response()->json(array('rows' => $affectedRows));
        }
        
        return response()->json(array('error' => '非法请求'));
    }
    
    /**
     * 编辑
     */
    public function actionEdit(Request $request, $actionId = null)
    {
        if ($request->isMethod('POST')) {
            $formData = $request->all();
            $validator = Validator::make($formData, [
                'role_id' => 'numeric',
                'permission_id[]' => 'array'
            ], array(
                'numeric' => ':attribute必须为数字',
                'array' => ':attribute必须选择一项',
            ));
    
            if ($validator->fails()) {
                return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput($formData);
            }
    
//             $status = $this->permission->updatePermissionById($formInfo);
    
//             if ($status) {
//                 $this->writeAdminLog($actionLogContent);
//                 return redirect('intranet/Privilege/list');
//             }
    
//             return view('intranet.pages.privilege_edit', array('errorMsg' => '操作失败！'));
        }
    
        if (empty($actionId)) {
            return redirect()->back();
        }
        
        $actionId = intval($actionId);
        // 必须传入一个数组
        $info = $this->role->getInfoById(array($actionId));
        return view('intranet.pages.role_edit', array('info' => $info));
    }
}