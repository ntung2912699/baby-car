<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\PasswordResetSuccess;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    protected function resetPassword($user, $password)
    {
        $user->password = bcrypt($password);
        $user->setRememberToken(Str::random(60));
        $user->save();

        // Get current date and time
        $datetime = Carbon::now()->toDateTimeString();

        // Get device information (this is a simple example, you might want to use a library like jenssegers/agent for more detailed device info)
        $device = request()->header('User-Agent');

        // Send the password reset success email
        Mail::to($user->email)->send(new PasswordResetSuccess($user, $datetime, $device));

        $this->guard()->login($user);
    }

    // Override redirect path
    protected function redirectPath()
    {
        return '/';  // Redirect to the homepage
    }
}