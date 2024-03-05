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
        // return $this->showAction->execute($userId);

        $result = $this->showAction->execute($userId);

        return response()->json([
            'data' => $result,
            'message' => 'Success', // 成功メッセージ
        ], 200); // HTTPステータスコード 200を返す
    }

    public function update(UpdateRequest $request, $userId)
    {
        // return $this->updateAction->execute($userId);

        $result = $this->updateAction->execute($userId);

        return response()->json([
            'data' => $result,
            'message' => 'Success', // 成功メッセージ
        ], 200); // HTTPステータスコード 200を返す
    }

    public function destroy(DestroyRequest $request, $userId)
    {
        // return $this->destroyAction->execute($userId);

        $result = $this->destroyAction->execute($userId);

        return response()->json([
            'data' => $result,
            'message' => 'Success', // 成功メッセージ
        ], 200); // HTTPステータスコード 200を返す
    }
}
