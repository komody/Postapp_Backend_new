<?php

namespace App\UseCases\Session;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterAction
{
    public function __invoke($request)
    {
        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ])) {
            $token = Auth::user()->createToken('AccessToken')->plainTextToken;
            return $token;
        }
    }
}