<?php

namespace App\Http\Controllers\Intranet;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Konohanaruto\Repositories\Intranet\User\UserRepositoryInterface;
use App\Konohanaruto\Infrastructures\Common\PasswordSecure;
use App\Konohanaruto\Repositories\Intranet\Role\RoleRepositoryInterface;
use App\Konohanaruto\Repositories\Intranet\UserRole\UserRoleRepositoryInterface;

class AdminController extends CoreController
{
    private $userRepository;
    private $role;
    private $passwordSecure;
    private $userRole;
    
    public function __construct(UserRepositoryInterface $userRepository, RoleRepositoryInterface $role, PasswordSecure $passwordSecure, UserRoleRepositoryInterface $userRole)
    {
        $this->userRepository = $userRepository;
        $this->role = $role;
        $this->passwordSecure = $passwordSecure;
        $this->userRole = $userRole;
        parent::__construct();
    }
    
    public function actionList()
    {
        $userList = $this->userRepository->getUserList();
        return view('intranet.pages.admin_user_list', array('userList' => $userList));
    }
    
    public function actionAdd(Request $request)
    {
        if ($request->isMethod('POST')) {
            // 表单验证
            $formData = $request->all();
            $formData['username'] = ! empty($formData['username']) ? trim($formData['username']) : '';
            $validator = Validator::make($formData, [
                'role_id' => 'required',
                'username' => 'unique:admin,username,null,admin_id',
                'password' => 'required',
            ], array(
                'unique' => '管理员名称已存在',
                'required' => ':attribute不能为空',
            ));
            
            if ($validator->fails()) {
                return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput($formData);
            }
            
            // 密码处理
            $salt = $this->passwordSecure->gernerateSalt();
            $formData['password'] = $this->passwordSecure->getEncryptPassword($formData['password'], $salt);
            $formData['create_time'] = date('Y-m-d H:i:s');
            $formData['salt'] = $salt;
            // 插入用户表
            $adminId = $this->userRepository->addUser($formData);
            
            // 用户角色表
            if ($adminId) {
                $create = array();
                foreach ($formData['role_id'] as $roleId) {
                    $create[] = array(
                        'admin_id' => $adminId,
                        'action_user_id' => $this->getCurrentUserId(),
                        'role_id' => $roleId
                    );
                }
                
                $status = $this->userRole->insertData($create);
                
                if ($status) {
                    $this->writeAdminLog('添加了"' . $formData['username'] . '"用户');
                    return redirect('intranet/AdminUserManage/list');
                }
            }
            
            return redirect()
            ->back()
            ->with('errorMsg', '插入失败')
            ->withInput($formData);
        }
        
        // 得到所有的角色
        $roleList = $this->role->getRoleList();
        return view('intranet.pages.admin_user_add', array('roleList' => $roleList));
    }
    
    public function actionEdit(Request $request, $userid = null)
    {
        if ($request->isMethod('POST')) {
            // 表单验证
            $formData = $request->all();
            $formData['username'] = ! empty($formData['username']) ? trim($formData['username']) : '';
            $validator = Validator::make($formData, [
                'role_id' => 'required',
                'username' => 'unique:admin,username,' . $userid . ',admin_id'
            ], array(
                'unique' => '管理员名称已存在',
                'required' => ':attribute不能为空',
            ));
            
            if ($validator->fails()) {
                return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput($formData);
            }
            
            $userInfo = $this->userRepository->getUserInfoById($userid);
            $oldUserName = $userInfo['username'];
            
            $updateData = array();
            // 密码处理
            $updateData['username'] = $formData['username'];
            $updateData['admin_id'] = $userid;
            
            if (! empty($formData['password'])) {
                $salt = $this->passwordSecure->gernerateSalt();
                $updateData['password'] = $this->passwordSecure->getEncryptPassword($formData['password'], $salt);
                $updateData['salt'] = $salt;
            }
            
            // 插入用户表
            $updateUserStatus = $this->userRepository->updateDataById($updateData);
            
            // 更新相关角色
            if ($updateUserStatus !== false) {
                $roles = $this->userRole->getRolesByUserId($userid);
                
                if (! empty($roles)) {
                    $roles = array_column($roles, 'role_id');
                }
                
                $deleteRoles = array_diff($roles, $formData['role_id']);
                $insertRoles = array_diff($formData['role_id'], $roles);
                
                if (! empty($deleteRoles)) {
                    $status = $this->userRole->deleteRowsByIdAndRoleId(array('admin_id' => $userid, 'role_id' => $deleteRoles));
                }
                
                if (! empty($insertRoles)) {
                    $insertData = array();
                    
                    foreach ($insertRoles as $roleId) {
                        $insertData[] = array('admin_id' => $userid, 'role_id' => $roleId);
                    }
                    
                    $this->userRole->insertData($insertData);   
                }
                
                // 记录日志
                if ($oldUserName != $formData['username']) {
                    $this->writeAdminLog('将"' . $oldUserName . '"用户的用户名修改为"' . $formData['username'] . '"');
                } else {
                    $this->writeAdminLog('修改了"' . $formData['username'] . '"的用户信息');
                }
                
                return redirect('intranet/AdminUserManage/list');
            }
            
            return redirect()
            ->back()
            ->with('errorMsg', '插入失败')
            ->withInput($formData);
        }
        
        if (empty($userid)) {
            return redirect()->back();
        }
        
        $userid = intval($userid);
        $info = $this->userRepository->getUserInfoById($userid);
        // 得到关联的角色
        $roles = $this->userRole->getRolesByUserId($userid);
        
        if (! empty($roles)) {
            $roles = array_column($roles, 'role_id');
        }
        
        // 得到所有的角色
        $roleList = $this->role->getRoleList();
        
        return view('intranet.pages.admin_user_edit', array(
            'info' => $info,
            'roles' => $roles,
            'roleList' => $roleList
        ));
    }
    
    public function actionDelete(Request $request)
    {
        if ($request->ajax()) {
            $actionId = $request->get('item_id');
    
            if (empty($actionId)) {
                return response()->json(array('error' => '您还没有选择需要删除的项'));
            }
    
    
            $actionItems = explode(',', $actionId);
            // 得到被删除的信息
            $deleteItemRows = $this->userRepository->getInfoById($actionItems);
            $affectedRows = $this->userRepository->removeDataById($actionId);
            
            // 删除role_permission表相应记录
            if ($affectedRows) {
                $this->userRole->removeDataByUserId($actionId);
            }
    
            // 更新相关删除日志
            if ($affectedRows) {
                foreach ($deleteItemRows as $info) {
                    $this->writeAdminLog('删除了"' . $info['username'] . '"用户');
                }
            }
    
            return response()->json(array('rows' => $affectedRows));
        }
        
        return response()->json(array('error' => '非法请求'));
    }
}
