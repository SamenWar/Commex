<?php

namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentsResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user_name' => $this->user_name,
            'email' => $this->email,
            'home_page' => $this->home_page,
            'text' => $this->text,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'children' => CommentsResource::collection($this->whenLoaded('children'))
        ];
    }
}
