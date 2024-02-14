<?php

namespace App\UseCases\User;

use App\Models\User;
use App\Http\Resources\UserResource;

class StoreAction
{
    public function execute($userId)
    {
        $user = User::find($userId);

        return new UserResource($user);
    }
}