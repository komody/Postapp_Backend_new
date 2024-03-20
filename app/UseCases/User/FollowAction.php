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

        // フォローを作成
        $follow = Follow::create([
            'following_user_id' => $followUserId,
            'followed_user_id' => $userId,
        ]);

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
// めも
// if ($followUserId !== (int)$userId) {のif文は認可（ポリシー）？
// ここはフォロー数の取得に成功したか失敗したかの判定だけにする。
// 自分自身をフォローしていたらreturnしてしまう。スローで例外を返す。
// /users/getのAPIでフォロー・フォロワー数の取得がnullになっちゃうので、Userモデルにfollow countとfollower countを入れる
// return new UserResource($followedUser);はコントローラで返す。2重になっている。