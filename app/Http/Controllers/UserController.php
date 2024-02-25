<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\User\ShowRequest;
use App\Http\Resources\UserResource;
use App\UseCases\User\ShowAction;
use App\UseCases\User\UpdateAction;


class UserController extends Controller
{
    //
    protected $storeAction;
    protected $updateAction;

    public function __construct(ShowAction $showAction, UpdateAction $updateAction)
    {
        $this->showAction = $showAction;
        $this->updateAction = $updateAction;
    }

    public function show(Request $request, $userId)
    {
        return $this->showAction->execute($userId);
    }
    public function update(Request $request, $userId)
    {
        return $this->updateAction->execute($userId);
    }
}
