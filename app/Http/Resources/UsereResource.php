<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UsereResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "email" => $this->email,
            "image" => $this->image,
            "email_verified_at" => $this->email_verified_at,
            "role" => $this->role,
            "status" => $this->status,
            'created_at' => $this->created_at->diffForHumans(),
            'blog' => BlogResource::collection($this->whenLoaded('blogs'))
        ];
    }
}
