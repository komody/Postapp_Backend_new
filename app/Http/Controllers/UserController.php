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

    public function show(ShowRequest $request, ShowAction $showAction, $userId)
    {
        // return $this->showAction->execute($userId);

        $result = $showAction($userId);

        return new UserResource($result);

    }

    public function update(UpdateRequest $request, UpdateAction $updateAction)
    {
        // return $this->updateAction->execute($userId);
        $userId = 1;//todo認証ユーザーのIDを渡す

        $result = $updateAction($userId, $request->name, $request->introduction, $request->icon_attachment_id);

        return new UserResource($result);
    }

    public function destroy(DestroyRequest $request, DestroyAction $destroyAction, $userId)
    {
        // return $this->destroyAction->execute($userId);

        $result = $destroyAction($userId);

        return new UserResource($result);
    }
}