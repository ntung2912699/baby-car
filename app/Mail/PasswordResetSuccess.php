<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PasswordResetSuccess extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $datetime;
    public $device;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $datetime, $device)
    {
        $this->user = $user;
        $this->datetime = $datetime;
        $this->device = $device;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Đổi Mật Khẩu Thành Công')
            ->view('emails.password_reset_success');
    }
}