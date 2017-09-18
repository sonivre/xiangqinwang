<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Log;

class HomeController extends Controller
{
    public function logging()
    {
        // 我取了所有logs这个collection(相当于Mysql的表)中的所有日志
        $logs = DB::connection('mongodb')->collection('logs')->get()->toArray();
        echo '<pre>';
        var_dump($logs);
    }
    
    public function storeLog()
    {
        // 使用默认的Log facade去保存日志，现在它会自动写入到Mongodb
        Log::info(md5(uniqid()));
    }
}
