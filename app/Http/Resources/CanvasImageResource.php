<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CanvasImageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'slug' => $this->slug,
            'width' => $this->width,
            'height' => $this->height,
            'user_id' => $this->user_id,

            'updated_at' => $this->updated_at->toIso8601String(),
            'updated_by' => new UserResource($this->updater),
        ];
    }
}
