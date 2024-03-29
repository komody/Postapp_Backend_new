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
            [
                'id' => $this->resource->id,
                'name' => $this->resource->name,
                'introduction' => $this->resource->introduction,
                'iconAttachment' => [
                    'id' => $this->resource->attachment_id,
                    'type' => 'string',
                    'url' => 'string',
                    'preview_url' => 'string',
                    'description' => 'string',
                ],
                'follow_count' => $this->resource->follow_count,
                'follower_count' => $this->resource->follower_count,
                'deletedAt' => $this->resource->deletedAt, 
            ]
        ];
    }
}