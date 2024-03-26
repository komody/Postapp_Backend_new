<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\UseCases\Post\IndexAction;
use App\UseCases\Post\CreateAction;
use App\UseCases\Post\UpdateAction;
use App\Http\Resources\PostResource;
use App\Http\Requests\Post\IndexRequest;
use App\Http\Requests\Post\CreateRequest;
use App\Http\Requests\Post\UpdateRequest;

class PostController extends Controller
{
    public function index(IndexRequest $request, IndexAction $indexAction)
    {
        $isFollowing = $request->query('isFollowing') === 'true';
        $posts = $indexAction($request, $isFollowing);
        return PostResource::collection($posts);
    }

    public function create(CreateRequest $request, CreateAction $createAction)
    {
        $post = $createAction($request);
        return new PostResource($post);
    }

    public function update(UpdateRequest $request, UpdateAction $updateAction, $postId)
    {
        $this->authorize('update', Post::findOrFail($postId));
        $post = $updateAction($request, $postId);
        return new PostResource($post);
    }
}