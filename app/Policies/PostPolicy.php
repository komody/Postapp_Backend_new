<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PostPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function update(User $user, Post $post)
    {
        // 自分の投稿を更新しようとしている場合は認可
        if ($user->id === $post->user_id) {
            return Response::allow();
        }

        // 他人の投稿を更新しようとしている場合は拒否
        return Response::deny('他人の投稿を更新することはできません。');
    }
}