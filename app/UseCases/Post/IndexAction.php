<?php

namespace App\UseCases\Post;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\PostResource;

class IndexAction
{
    public function __invoke(Request $request)
    {
        $userId = Auth::id();

        $followingUserId = auth()->user()->following->pluck('id');
        $postList = Post::whereIn('user_id', $followingUserId)
        ->orderByDesc('created_at') // 投稿順（created_atカラムの降順）
        ->get();

        return PostResource::collection($postList);
    }
}

// 参考記事
// https://qiita.com/mitsu-0720/items/68e52e4b56eb749a5283

// Property [id] does not exist on this collection instance.の解決策
// https://biz.addisteria.com/where_get_error/