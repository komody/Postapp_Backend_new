<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Http\Resources\AttachmentResource;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'parent_id' => $this->resource->parent_id,
            'content' => $this->resource->content,
            'like_count' => $this->resource->like_count,
            'reply_count' => $this->resource->reply_count,
            'user' => new UserResource($this->resource->user),
            'attachments' => new AttachmentResource($this->resource->attachments),
            'created_at' => $this->resource->created_at,
        ];
    }
}

// クリーンアーキテクチャ記事通りに実装
// https://zenn.dev/mpyw/articles/ce7d09eb6d8117