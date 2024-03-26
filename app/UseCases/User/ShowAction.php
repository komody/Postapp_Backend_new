<?php

namespace App\UseCases\User;

use App\Models\User;
use App\Http\Resources\UserResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class ShowAction
{
    public function __invoke($userId)
    {
        try {
            $user = User::findOrFail($userId);

            // フォロー数とフォロワー数を取得
            $followCount = $user->followCount($userId);
            $followerCount = $user->followerCount($userId);

            // フォロー数とフォロワー数をユーザーモデルにセット
            $user->follow_count = $followCount;
            $user->follower_count = $followerCount;

            return $user;

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