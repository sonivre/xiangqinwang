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
            $formData = array();
            $formData['role_name'] = $request->get('role_name');
            $formData['granted_permissions'] = empty($request->get('permission_id')) ? array() : $request->get('permission_id');
            $formData['user_id'] = $this->getCurrentUserId();
            $formData['role_id'] = $request->get('role_id');
            
            // 相关信息修改
            if ($formData['role_id']) {
                // 修改角色名称
                $status = $this->role->updateDataByRoleId($formData);
                
                if ($status) {
                    // 得到目前所有的已赋有的权限
                    $res = $this->rolePermission->getPermissionsByRoleId($formData['role_id']);
                    $res = $res ? $res : array();
                    $selectedPermissions = array();
                    
                    foreach ($res as $per) {
                        array_push($selectedPermissions, $per['permission_id']);
                    }
                    
                    if (! empty($selectedPermissions)) {
                        foreach ($selectedPermissions as $s => $selectId) {
                            // 只有当客户端提交的不为空才进行差异处理
                            if (! empty($formData['granted_permissions'])) {
                                foreach ($formData['granted_permissions'] as $g => $grantedId) {
                                    // 存在公共元素
                                    if ($selectId == $grantedId) {
                                        unset($selectedPermissions[$s]);
                                        unset($formData['granted_permissions'][$g]);
                                        break;
                                    }
                                }
                            }
                        }
                    } else {
                        $selectedPermissions = array();
                    }
                    
                    // 得到需要删除和需要新增的元素
                    $deletingPermissions = $selectedPermissions;
                    $insertPermissions = $formData['granted_permissions'];
                    echo '<pre>';var_dump($deletingPermissions);
                    echo '<hr>';
                    var_dump($insertPermissions);exit;
                    
                }
            }
            
            // 操作失败返回
            return redirect()
            ->back()
            ->withInput($formData);
        }
    
        if (empty($actionId)) {
            return redirect()->back();
        }
        
        $actionId = intval($actionId);
        // 必须传入一个数组
        $info = $this->role->getInfoById(array($actionId));
        // 取出权限树
        $permissions = $this->permissionRepository->getPermissionTrees();
        // 得到被选中的权限
        $selectPermissions = $this->rolePermission->getPermissionsByRoleId($actionId);
        $selectedPermissionId = array();
        
        if (! empty($selectPermissions)) {
            foreach ($selectPermissions as $current => $item) {
                $selectedPermissionId[] = $item['permission_id'];
            }
        }
        
        if (! empty($info[0])) {
            $info = $info[0];
        }
        
        return view('intranet.pages.role_edit', array(
            'info' => $info,
            'permissions' => $permissions,
            'selectedPermissionId' => $selectedPermissionId
        ));
    }
}