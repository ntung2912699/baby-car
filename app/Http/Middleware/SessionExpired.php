<?php


namespace App\Http\Middleware;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class SessionExpired extends Middleware
{
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('login'); // Chuyển hướng người dùng đến trang login
        }
    }
}