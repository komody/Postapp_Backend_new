<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\DestroyRequest;
use App\UseCases\Session\CreateAction;
use App\UseCases\Session\DestroyAction;
use App\Http\Requests\Session\CreateRequest;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    protected $createAction;
    protected $destroyAction;

    public function __construct(CreateAction $createAction, DestroyAction $destroyAction)
    {
        $this->createAction = $createAction;
        $this->destroyAction = $destroyAction;
    }

    public function create(CreateRequest $request)
    {
        return $this->createAction->execute($request);
    }

    public function destroy(DestroyRequest $request)
    {
        return $this->destroyAction->execute($request);
    }
}

// 参考記事
// 【Laravel】SanctumでAPIトークン認証の使い方とSPA認証との比較
// https://qiita.com/104dev/items/0787a81f7dda892ce86a