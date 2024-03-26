<?php

namespace App\UseCases\Post;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UpdateAction
{
    public function __invoke(Request $request, $postId)
    {
        $post = Post::findOrFail($postId);
        $post->content = $request->input('content');
        $post->attachment_id = $request->input('attachment_id');

        $post->save();
        return $post;
    }
}
