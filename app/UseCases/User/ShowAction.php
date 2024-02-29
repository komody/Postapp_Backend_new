<?php

namespace App\UseCases\User;

use App\Models\User;
use App\Http\Resources\UserResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class ShowAction
{
    public function execute($userId)
    {
        $user = User::findOrFail($userId);

        try {
            return new UserResource($user);
        
        } catch (ModelNotFoundException $e) {
            // データが見つからなかっただけならロギング不要
            throw $e;
        } catch (\Throwable $e) {
            // それ以外のエラーは想定外なのでログに残す
            \Log::error($e);
            
            // フロントに異常を通知するため例外はそのまま投げる
            throw $e;
        }
    }
}