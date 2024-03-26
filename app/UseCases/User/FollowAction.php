<?php

namespace App\UseCases\User;

use App\Models\User;
use App\Models\Follow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\UserResource;

class FollowAction
{
    public function __invoke(Request $request, $userId)
    {
        $followUserId = Auth::id();

        // フォローを作成し、成功したかどうかをチェック
        $follow = Follow::create([
            'following_user_id' => $followUserId,
            'followed_user_id' => $userId,
        ]);
        if (!$follow) {
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