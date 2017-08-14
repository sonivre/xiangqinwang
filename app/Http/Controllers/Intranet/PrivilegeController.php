<?php

namespace App\Http\Controllers\Intranet;

use Illuminate\Http\Request;
use Validator;
use App\Konohanaruto\Repositories\Intranet\Permission\PermissionRepositoryInterface;
use App\Konohanaruto\Repositories\Intranet\RolePermission\RolePermissionEloquentRepository;

class PrivilegeController extends CoreController
{
    protected $permission;
    protected $rolePermission;
    
    public function __construct(PermissionRepositoryInterface $permission, RolePermissionEloquentRepository $rolePermission)
    {
        $this->permission = $permission;
        $this->rolePermission = $rolePermission;
        parent::__construct();
    }
    
    public function actionList()
    {
        $permissionList = $this->permission->getPermissionList();
        $permissionList = $this->permission->getPermissionTree($permissionList);
        return view('intranet.pages.privilege_list', array('permissionList' => $permissionList));
    }
    
    public function actionAdd(Request $request)
    {
        if ($request->isMethod('POST')) {
            $userinfo = $request->session()->get(config('custom.intranetSessionName'));
            $permissionData = array();
            $permissionData['permission_name_en'] = $request->get('permission_name_en');
            $permissionData['permission_name_zh'] = $request->get('permission_name_zh');
            $permissionData['action_user_id'] = intval($userinfo['admin_id']);
            $permissionData['parent_id'] = intval($request->get('parent_id'));
            $permissionData['create_time'] = date('Y-m-d H:i:s');
            $permissionData['update_time'] = date('Y-m-d H:i:s');
            $result = $this->permission->addPermission($permissionData);
            if ($result) {
                // 写入管理员日志
                $this->writeAdminLog('添加了"' . $request->get('permission_name_en') . '"权限');
                return redirect('intranet/Privilege/list');
            }
            return view('intranet.pages.privilege_add', array(
                'errorMsg' => '添加失败！ 已存在的权限或网络错误！'
            ));
        }
        
        // 得到顶级分类列表
        $topPermissions = $this->permission->getTopPermissions();
        return view('intranet.pages.privilege_add', array('topPermissions' => $topPermissions));
    }
    
    public function actionEdit(Request $request, $permissionId = null)
    {
        if ($request->isMethod('POST')) {
            $formInfo = $request->all();
            $validator = Validator::make($formInfo, [
                'permission_id' => 'numeric',
                'parent_id' => 'numeric',
                'permission_name_zh' => 'required',
                'permission_name_en' => 'required',
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
            
            // 判断更改的具体内容, 记录管理员日志
            if ($formInfo['old_permission_name_en'] == $formInfo['permission_name_en']) {
                $actionLogContent = '修改了权限"' . $formInfo['permission_name_en'] . '"';
            } else {
                $actionLogContent = '将权限"' . $formInfo['old_permission_name_en'] . '"更名为"' . $formInfo['permission_name_en'] . '"';
            }
            
            $status = $this->permission->updatePermissionById($formInfo);
            
            if ($status) {
                $this->writeAdminLog($actionLogContent);
                return redirect('intranet/Privilege/list');
            }
            
            return view('intranet.pages.privilege_edit', array('errorMsg' => '操作失败！'));
        }
        
        if (empty($permissionId)) {
            return redirect()->back();
        }
        
        $permissionId = intval($permissionId);
        $info = $this->permission->getInfoById(array($permissionId));
        $info = ! empty($info[0]) ? $info[0] : array();
        $categoryInfo = $this->permission->getTopPermissions();
        $info['topCategory'] = $categoryInfo;
        return view('intranet.pages.privilege_edit', array('info' => $info));
    }
    
    public function actionDelete(Request $request, $permissionId = null)
    {
        if ($request->ajax()) {
            $permissionId = $request->get('permission_id');
            
            if (empty($permissionId)) {
                return response()->json(array('error' => '您还没有选择需要删除的项'));
            }
            
            
            $permissionItems = explode(',', $permissionId);
            // 判断当前分类下是否有子分类, 如有, 删除失败
            $status = $this->permission->checkChildrenStatus($permissionItems);
            
            if (! $status) {
                return response()->json(array('error' => '当前分类下存在子分类, 删除失败'));
            }
            
            $deletePermissionRows = $this->permission->getInfoById($permissionItems);
            $affectedRows = $this->permission->removeDataById($permissionId);
            // 删除角色权限表中冗余的数据，也就是删除和该权限相关联的所有数据
            $this->rolePermission->removeAllByPermissionId($permissionId);
            
            // 更新相关删除日志
            if ($affectedRows) {
                foreach ($deletePermissionRows as $permissionInfo) {
                    $this->writeAdminLog('删除了"' . $permissionInfo['permission_name_en'] . '"权限');
                }
            }
            
            return response()->json(array('rows' => $affectedRows));
        }
        
        return response()->json(array('errorMsg' => '非法访问'));
    }
}
