<?php

namespace App\Http\Controllers\Intranet;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Konohanaruto\Repositories\Intranet\AdminActivity\AdminActivityEloquentRepository;

class CoreController extends Controller
{
    protected $adminLog;
    
    public function __construct(AdminActivityEloquentRepository $adminLog = null)
    {
        if (! $adminLog) {
            $this->adminLog = new AdminActivityEloquentRepository();
        }
    }
    
    /**
     * 写入管理员操作表
     * 
     * @param unknown $content
     * @return boolean
     */
    public function writeAdminLog($content, $ip = '')
    {
        return $this->adminLog->saveLog($content, $ip);
    }
}
