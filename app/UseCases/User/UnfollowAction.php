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
        $unfollowUserId = Auth::id();

        // フォローを解除し、成功したかどうかをチェック
        $unfollow = Follow::where([
            'following_user_id' => $unfollowUserId,
            'followed_user_id' => $userId,
        ])->delete();
        if (!$unfollow) {
            throw new \Exception('エラーが発生しました。しばらくしてからやり直してください。');
        }

        // フォローを作成したUserを取得
        $result = User::find($userId);

        // フォロー数とフォロワー数を取得
        $followCount = $result->followCount($userId);
        $followerCount = $result->followerCount($userId);

        // フォロー数とフォロワー数をユーザーモデルにセット
        $result->follow_count = $followCount;
        $result->follower_count = $followerCount;

        return $result;
    }
}
