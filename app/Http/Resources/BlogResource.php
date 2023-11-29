<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class BlogResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'image' => Storage::disk('public')->url($this->image),
            'created_at' => $this->created_at->diffForHumans(),
            'updated_at' => Carbon::parse($this->updated_at)->format('Y-M-d h:s a'),
        ];
    }
}
