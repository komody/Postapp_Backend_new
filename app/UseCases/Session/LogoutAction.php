<?php

namespace App\UseCases\Session;

use App\Models\User;
use Illuminate\Http\Request;

class LogoutAction
{
    public function __invoke($request)
    {
        // ログインしているかどうかを確認
        if ($request->user()) {
            $request->user()->currentAccessToken()->delete();
            return response()->json(['message' => 'ログアウトしました。'], 200);
        } else {
            // ログインしていない場合の処理
            return response()->json(['message' => 'ログアウトできません。'], 401);
        }
    }
}