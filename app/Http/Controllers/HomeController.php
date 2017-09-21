<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Log;
use App\Konohanaruto\Jobs\Intranet\SendTestEmail;
use App\Konohanaruto\Repositories\Intranet\User\UserRepositoryInterface;
use Flc\Dysms\Client;
use Flc\Dysms\Request\SendSms;
use Config;

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
    
    public function smsTest()
    {
        $config = Config::get('custom.aliyunSMS');
        $client  = new Client($config);
        $sendSms = new SendSms;
        $sendSms->setPhoneNumbers('18672670383');
        $sendSms->setSignName(env('ALIYUN_SIGN_NAME'));
        $sendSms->setTemplateCode(env('ALIYUN_TEMPLATE_CODE'));
        $sendSms->setTemplateParam(['code' => rand(100000, 999999)]);
        $sendSms->setOutId('konohanaruto');
        
        print_r($client->execute($sendSms));
    }
}
