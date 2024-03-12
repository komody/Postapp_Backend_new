<?php

namespace App\UseCases\Post;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexAction
{
    public function __invoke(Request $request, bool $isFollowing)
    {
        $userId = Auth::id();
        $followingUserId = auth()->user()->following->pluck('followed_user_id')->toArray();
        if ($isFollowing) {
            $postList = Post::whereIn('user_id', array_merge($followingUserId, [$userId]))
                ->orderByDesc('created_at') // 投稿順（created_atカラムの降順）
                ->get();
        } else {
            $postList = Post::orderByDesc('created_at')->get();
        }
        return $postList;
    }
}