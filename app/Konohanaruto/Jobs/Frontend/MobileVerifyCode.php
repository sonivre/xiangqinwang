<?php

namespace App\Konohanaruto\Jobs\Frontend;

use App\Konohanaruto\Infrastructures\Common\SMS\ShortMessageServiceInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Log;

class MobileVerifyCode implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $phoneNumber;
    protected $code;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($phoneNumber, $code)
    {
        $this->phoneNumber = $phoneNumber;
        $this->code = $code;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(ShortMessageServiceInterface $sms)
    {
        $response = $sms->send($this->phoneNumber, array('code' => $this->code));
        Log::info(trans('register_service.aliyun_mobile_code_response') . json_encode($response, JSON_UNESCAPED_SLASHES));
    }
}
