<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\User\ShowRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Http\Requests\User\DestroyRequest;
use App\Http\Resources\UserResource;
use App\UseCases\User\ShowAction;
use App\UseCases\User\UpdateAction;
use App\UseCases\User\DestroyAction;


class UserController extends Controller
{
    //
    protected $storeAction;
    protected $updateAction;
    protected $destroyAction;

    public function __construct(
        ShowAction $showAction, 
        UpdateAction $updateAction,
        DestroyAction $destroyAction)
    {
        $this->showAction = $showAction;
        $this->updateAction = $updateAction;
        $this->destroyAction = $destroyAction;
    }

    public function show(ShowRequest $request, $userId)
    {
        return $this->showAction->execute($userId);
    }

    public function update(UpdateRequest $request, $userId)
    {
        return $this->updateAction->execute($userId);
    }

    public function destroy(DestroyRequest $request, $userId)
    {
        return $this->destroyAction->execute($userId);
    }
}
