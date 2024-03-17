<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\AttachmentResource;
use App\UseCases\Attachment\CreateAction;
use App\Http\Requests\Attachment\CreateRequest;

class AttachmentController extends Controller
{
    //
    public function create(CreateRequest $request, CreateAction $createAction)
    {
        $result = $createAction($request);

        return new AttachmentResource($result);
    }
}
