<?php

namespace App\Mail\Frontend;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use UserUniversalData;

class RegisterMemberActivation extends Mailable
{
    use Queueable, SerializesModels;

    public $userId;
    public $username;
    public $email;
    public $activationUrl;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($userId, $username, $email)
    {
        $this->userId = $userId;
        $this->username = $username;
        $this->email = $email;
        $this->activationUrl = $this->getAccountActivationUrl();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject(trans('register_service.register_activation_email_subject'))
            ->view('mails.frontend.register_member_activation');
    }

    private function getAccountActivationUrl()
    {
        $token = UserUniversalData::accountMailActivationToken($this->userId, $this->username, $this->email);

        return url('User/activationAccount') . '?code=' . urlencode($token);
    }
}
