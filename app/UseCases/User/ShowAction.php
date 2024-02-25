<?php

namespace App\UseCases\User;

use App\Models\User;
use App\Http\Resources\UserResource;

class ShowAction
{
    public function execute($userId)
    {
        $user = User::find($userId);

        return new UserResource($user);
    }
}