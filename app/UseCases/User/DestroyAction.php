<?php

namespace App\UseCases\User;

use App\Models\User;
use App\Http\Resources\UserResource;

class DestroyAction
{
    public function execute($userId)
    {
        $user = User::destroy($userId);

        try {
            return new UserResource($user);
        } catch (\Throwable $e) {
            // 全てのエラー・例外をキャッチしてログに残す
            \Log::error($e);

            // フロントに異常を通知するため例外はそのまま投げる
            throw $e;
        }
    }
}