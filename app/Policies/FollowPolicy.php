<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Follow;
use Illuminate\Auth\Access\Response;

class FollowPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function follow(User $user, $userId)
    {
        // フォローする相手の$userIdが存在しないかどうかを確認
        $followUser = User::find($userId);

        if (!$followUser) {
            // フォローする相手の$userIdが存在しない場合
            throw new \InvalidArgumentException('対象のユーザーが見つかりません。');
        }

        // 自分自身をフォローしようとしている場合は認可しない
        if ($user->id == $userId) {
            return Response::deny('自分自身をフォローすることはできません。');
        }

        // すでにフォローしている場合は認可しない
        $existingFollow = Follow::where('following_user_id', $user->id)
            ->where('followed_user_id', $userId)
            ->exists();
        
        if ($existingFollow) {
            return Response::deny('すでにフォローしています。');
        }

        // その他の場合は認可
        return Response::allow();
    }

    public function unfollow(User $user, $userId)
    {
        // フォロー解除する相手の$userIdが存在しないかどうかを確認
        $followUser = User::find($userId);

        if (!$followUser) {
            // フォロー解除する相手の$userIdが存在しない場合
            throw new \InvalidArgumentException('対象のユーザーが見つかりません。');
        }

        // 自分自身をフォロー解除しようとしている場合は認可しない
        if ($user->id == $userId) {
            return Response::deny('自分自身をフォロー解除することはできません。');
        }

        // フォローしていていない場合は認可しない
        $existingFollowed = Follow::where('following_user_id', $user->id)
        ->where('followed_user_id', $userId)
        ->exists();
    
        if (!$existingFollowed) {
            // フォローしていない場合はエラーを返す
            return Response::deny('まだフォローしていません。');
        }

        // その他の場合は認可
        return Response::allow();
    }
}