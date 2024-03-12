<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UseCases\Post\IndexAction;
use App\UseCases\Post\CreateAction;
use App\Http\Resources\PostResource;
use App\Http\Requests\Post\IndexRequest;
use App\Http\Requests\Post\CreateRequest;

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
}