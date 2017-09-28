<?php

namespace App\Konohanaruto\Jobs\Frontend;

use App\Konohanaruto\Infrastructures\Common\SMS\ShortMessageServiceInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

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
        $sms->send($this->phoneNumber, array('code' => $this->code));
    }
}
