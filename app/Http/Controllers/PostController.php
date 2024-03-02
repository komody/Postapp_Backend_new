<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UseCases\Post\IndexAction;
use App\UseCases\Post\CreateAction;
use App\Http\Requests\Post\IndexRequest;
use App\Http\Requests\Post\CreateRequest;

class PostController extends Controller
{
    public function index(IndexRequest $request, IndexAction $indexAction)
    {
        $post = $indexAction($request);
        return response()->json($post, 200);
    }

    public function create(CreateRequest $request, CreateAction $createAction)
    {
        $post = $createAction($request);
        return response()->json($post, 200);
    }
}
