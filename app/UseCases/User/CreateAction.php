<?php

namespace App\UseCases\User;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\UserResource;

class CreateAction
{
    public const TOKEN_NAME = 'app_api_token';
    public function execute($request)
    {
        if (Auth::attempt([
            'name' => $request->name,
            'password' => $request->password,
            'introduction' => $request->introduction,
            'icon_attachment_id' => $request->iconAttachmentId
        ])) {
            $token = Auth::user()->createToken('AccessToken')->plainTextToken;
            return response()->json(['token' => $token], 200);
        } else {
            return response()->json(['error' => '認証に失敗しました。'], 401);
        }
        return new UserResource($user);
    }
}