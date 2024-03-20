<?php

namespace App\UseCases\User;

use App\Models\User;
use App\Models\Follow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\UserResource;

class UnfollowAction
{
    public function __invoke(Request $request, $userId)
    {
        $followUserId = Auth::id();

        // フォローを解除
        $follow = Follow::where([
            'following_user_id' => $followUserId,
            'followed_user_id' => $userId,
        ])->delete();

        // フォローを作成したユーザーを取得
        $result = User::find($userId);

        // フォロー数とフォロワー数を取得し、成功したかどうかを判定
        $followCount = $result->followCount($userId);
        $followerCount = $result->followerCount($userId);

        // フォロー数とフォロワー数をユーザーモデルにセット
        $result->follow_count = $followCount;
        $result->follower_count = $followerCount;

        return $result;
    }
}