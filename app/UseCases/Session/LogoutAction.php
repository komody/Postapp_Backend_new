<?php

namespace App\UseCases\Session;

use Illuminate\Http\Request;

class LogoutAction
{
    public function __invoke($request)
    {
        // ログインしているかどうかを確認
        if ($request->user()) {
            $request->user()->currentAccessToken()->delete();
            return true;
        } else {
            return false;
        }
    }
}
