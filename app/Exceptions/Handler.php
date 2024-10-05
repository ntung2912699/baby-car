<?php


namespace App\Exceptions;


class Handler
{
    public function unauthenticated($request, \Illuminate\Auth\AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['message' => 'Session expired. Please login again.'], 401);
        }

        return redirect()->guest(route('login'));
    }
}