<?php

namespace App\Api\Resources;

/**
 * Post resource to implement model into response.
 */
class PostResource extends \Illuminate\Http\Resources\Json\JsonResource
{
    /**
     * {@inheritdoc}
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'shortDescription' => $this->short_description,
            'description' => $this->description,
            'createdAt' => $this->created_at->toIso8601String(),
            'updatedAt' => $this->updated_at->toIso8601String(),
        ];
    }
}
