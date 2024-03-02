<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AttachmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            'id' => $this->resource->id,
            'type' => $this->resource->type,
            'url' => $this->resource->url,
            'preview_url' => $this->resource->preview_url,
            'description' => $this->resource->description,
        ];
    }
}

// Attachment:
// type: object
// properties:
//   id:
//     type: integer
//     format: int64
//     example: 1
//   type:
//     type: string
//   url:
//     type: string
//   preview_url:
//     type: string
//   description:
//     type: string
