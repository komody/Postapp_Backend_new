<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\UseCases\User\StoreAction;
use App\UseCases\User\CreateAction;
use App\Http\Resources\UserResource;
use App\Http\Requests\User\ShowRequest;


class UserController extends Controller
{
    //
    protected $storeAction;
    protected $createAction;

    public function __construct(StoreAction $storeAction, CreateAction $createAction)
    {
        $this->storeAction = $storeAction;
        $this->createAction = $createAction;
    }

    public function show(Request $request, $userId)
    {
        return $this->storeAction->execute($userId);
    }

    public function create(Request $request)
    {
        return $this->createAction->execute($request);
    }
}
