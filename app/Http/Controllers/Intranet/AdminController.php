<?php

namespace App\Http\Controllers\Intranet;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Konohanaruto\Repositories\Intranet\User\UserRepositoryInterface;
use App\Konohanaruto\Repositories\Intranet\Role\RoleEloquentRepository;
use App\Konohanaruto\Infrastructures\Common\PasswordSecure;
use App\Konohanaruto\Repositories\Intranet\UserRole\UserRoleEloquentRepository;

class AdminController extends CoreController
{
    private $userRepository;
    private $role;
    private $passwordSecure;
    private $userRole;
    
    public function __construct(UserRepositoryInterface $userRepository, RoleEloquentRepository $role, PasswordSecure $passwordSecure, UserRoleEloquentRepository $userRole)
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
            $formInfo = $request->all();
            $validator = Validator::make($formInfo, [
                'user_id' => 'numeric',
            ], array(
                'numeric' => ':attribute必须为数字',
            ));
        
            if ($validator->fails()) {
                return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput($formInfo);
            }
        
            $status = $this->userRepository->updateUserInfoById($formInfo);
        
            if ($status) {
                return redirect('intranet/AdminUserManage/list');
            }
        
            return view('intranet.pages.admin_user_edit', array('errorMsg' => '操作失败！'));
        }
        
        if (empty($userid)) {
            return redirect()->back();
        }
        
        $userid = intval($userid);
        $info = $this->userRepository->getInfoById($userid);
        return view('intranet.pages.admin_user_edit', array('info' => $info));
    }
    
    public function actionDelete()
    {
        
    }
}
