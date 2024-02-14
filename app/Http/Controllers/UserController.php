<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\User\ShowRequest;
use App\Http\Resources\UserResource;
use App\UseCases\User\StoreAction;


class UserController extends Controller
{
    //
    protected $storeAction;

    public function __construct(StoreAction $storeAction)
    {
        $this->storeAction = $storeAction;
    }

    public function show(Request $request, $userId)
    {
        return $this->storeAction->execute($userId);
    }
}
