<?php

namespace App\Services;

use Illuminate\Support\Facades\Mail;

class OtpServices
{
    public function sendOtp($user)
    {
        $otpCode = rand(100000, 999999); // Tạo mã OTP 6 chữ số
        $user->otp_code = $otpCode;
        $user->save();

        Mail::to($user->email)->send(new \App\Mail\SendVerifyCodeMail($otpCode));
    }
}
