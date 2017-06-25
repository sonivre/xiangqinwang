<?php
namespace App\Konohanaruto\Repositories\Intranet\AdminActivity;

use App\Konohanaruto\Repositories\Intranet\EloquentRepository;

class AdminActivityEloquentRepository extends EloquentRepository implements AdminActivityRepositoryInterface
{

    public function getModel()
    {
        return \App\Konohanaruto\Models\Intranet\AdminLog::class;
    }
    
    /**
     * 接口实现
     * @see \App\Konohanaruto\Repositories\Intranet\AdminActivity\AdminActivityRepositoryInterface::getAllLogs()
     */
    public function getAllLogs()
    {
        
    }
    
    /**
     * 记录管理员操作日志
     * 
     * @param unknown $content
     * @return boolean
     */
    public function saveLog($content = '')
    {
        $data = array();
        $userinfo = session(config('custom.intranetSessionName'));
        $data['admin_name'] = $userinfo['username'];
        $data['admin_id'] = $userinfo['admin_id'];
        $data['ip'] = $userinfo['ip'];
        $data['create_time'] = date('Y-m-d H:i:s');
        $data['content'] = $content;
        return $this->model->writeAdminActionLog($data);
    }
}