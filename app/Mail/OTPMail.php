<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OTPMail extends Mailable
{
    use Queueable, SerializesModels;

    public $otp;

    public $name;

    public $url;

    public function __construct($otp, $name, $url)
    {
        $this->otp = $otp;
        $this->name = $name;
        $this->url = $url;
    }

    public function build()
    {
        return $this->subject('Mã OTP Xác Nhận Đăng Kí Tài Khoản Tại Navy Oto')
            ->view('emails.otp')
            ->with([
                'otp' => $this->otp,
                'name' => $this->name,
                'url' => $this->url,
            ]);
    }
}

