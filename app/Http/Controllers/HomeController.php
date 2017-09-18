<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Log;
use App\Konohanaruto\Jobs\Intranet\SendTestEmail;
use App\Konohanaruto\Repositories\Intranet\User\UserRepositoryInterface;

class HomeController extends Controller
{
    public function logging()
    {
        $logs = DB::connection('mongodb')->collection('logs')->get()->toArray();
        echo '<pre>';
        var_dump($logs);
    }
    
    public function storeLog()
    {
        Log::info(md5(uniqid()));
    }
    
    public function jobFeatureTest()
    {
        // method 1:
        
        //dispatch(new SendTestEmail());
        
        // method 2:
        
        $job = (new SendTestEmail())->onQueue('SendTestEmail');
        dispatch($job);
    }
}
