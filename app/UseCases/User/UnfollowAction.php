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
        // 自分自身をフォローしようとしていないかをチェック
        if ($followUserId !== (int)$userId) {
            // フォローを作成
            $follow = Follow::where([
                'following_user_id' => $followUserId,
                'followed_user_id' => $userId,
            ])->delete();
        
            // フォロー数を取得
            $followCount = Follow::where('following_user_id', $userId)->count();

            // フォロワー数を取得
            $followerCount = Follow::where('followed_user_id', $userId)->count();

            // フォローを作成したユーザーを取得
            $followedUser = User::find($userId);
            // フォロー数とフォロワー数をユーザーモデルにセット
            $followedUser->follow_count = $followCount;
            $followedUser->follower_count = $followerCount;

            // UserResourceに渡すデータに id、フォロー数、フォロワー数を含める
            return new UserResource($followedUser);
        }
    }
}