<?php

namespace App\UseCases\User;

use App\Models\User;
use App\Http\Resources\UserResource;

class UpdateAction
{
    public function execute($userId)
    {
        $user = User::update($userId);

        return new UserResource($user);
    }
}