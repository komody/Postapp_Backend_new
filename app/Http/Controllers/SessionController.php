<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\Session\RegisterRequest;
use App\Http\Requests\Session\LoginRequest;
use App\Http\Requests\Session\LogoutRequest;
use App\UseCases\Session\RegisterAction;
use App\UseCases\Session\LoginAction;
use App\UseCases\Session\LogoutAction;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    public function register(RegisterRequest $request, RegisterAction $registerAction)
    {
        $token = $registerAction($request);
        return response()->json(['jwtToken' => $token], 200);
    }

    public function login(LoginRequest $request, LoginAction $loginAction)
    {
        $token = $loginAction($request);
        return response()->json(['jwtToken' => $token], 200);
    }

    public function logout(LogoutRequest $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'ログアウトしました。'], 200);
    }
}

// 参考記事
// 【Laravel】SanctumでAPIトークン認証の使い方とSPA認証との比較
// https://qiita.com/104dev/items/0787a81f7dda892ce86a