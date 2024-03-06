<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\UseCases\User\ShowAction;
use App\UseCases\User\UpdateAction;
use App\Http\Resources\UserResource;
use App\UseCases\User\DestroyAction;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\User\ShowRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Http\Requests\User\DestroyRequest;


class UserController extends Controller
{
    //

    public function show(ShowRequest $request, ShowAction $showAction, $userId)
    {
        // return $this->showAction->execute($userId);

        $result = $showAction($userId);

        return new UserResource($result);

    }

    public function update(UpdateRequest $request, UpdateAction $updateAction)
    {
        // return $this->updateAction->execute($userId);
        $userId = Auth::id();

        $result = $updateAction($userId, $request->name, $request->introduction, $request->iconAttachmentId);

        return new UserResource($result);
    }

    public function destroy(DestroyRequest $request, DestroyAction $destroyAction, $userId)
    {
        // return $this->destroyAction->execute($userId);

        $result = $destroyAction($userId);

        return new UserResource($result);
    }
}