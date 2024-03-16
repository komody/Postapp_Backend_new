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
        // 自分自身をフォローしようとしていないかをチェック
        if ($followUserId !== (int)$userId) {
            // フォローを作成
            $follow = Follow::create([
                'following_user_id' => $followUserId,
                'followed_user_id' => $userId,
            ]);
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


// めも
// 自分がフォローすると、自分のフォロー数が増えて、相手のフォロワー数が増える
// 相手からフォローされると、相手のフォロー数が増えて、自分のフォロワー数が増える

// mysql> select * from follows;
// +----+-------------------+------------------+------------+------------+
// | id | following_user_id | followed_user_id | created_at | updated_at |
// +----+-------------------+------------------+------------+------------+
// |  1 |                 3 |                4 | NULL       | NULL       |
// |  2 |                 1 |                3 | NULL       | NULL       |
// +----+-------------------+------------------+------------+------------+
// 2 rows in set (0.00 sec)


// 1のユーザーfollowing_user_idは、3のユーザーfollowed_user_idをフォローしているので、フォロー数は1
// 1のユーザーfollowed_user_idは、誰からもフォローされていないので、フォロワー数は0

// 3のユーザーfollowing_user_idは、4のユーザーfollowed_user_idをフォローしているので、フォロー数は1
// 3のユーザーfollowed_user_idは、1のユーザーfollowing_user_idにフォローされているので、フォロワー数は1