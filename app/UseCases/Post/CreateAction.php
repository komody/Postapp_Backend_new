<?php

namespace App\UseCases\Post;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Auth;

class CreateAction
{
    public function __invoke(Request $request)
    {
        $userId = Auth::id();

        $post = new Post([
            'parent_id' => $request->input('parent_id'),
            'content' => $request->input('content'),
            'like_count' => $request->input('like_count', 0),
            'user_id' => $userId,
            'attachment_id' => $request->input('attachmentId'),
        ]);

        $post->save();
        return new PostResource($post);
    }
}