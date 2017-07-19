<?php

namespace App\Http\Controllers\Intranet;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
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
        return view('intranet.pages.admin_user_add');
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
