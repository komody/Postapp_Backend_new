<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'name' => $this->resource->name,
            'introduction' => $this->resource->introduction,
            'iconAttachmentId' => $this->resource->iconAttachmentId,
            'deletedAt' => $this->resource->deletedAt, 
        ];
    }
}