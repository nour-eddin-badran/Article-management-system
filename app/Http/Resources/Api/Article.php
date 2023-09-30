<?php

namespace App\Http\Resources\Api;

use App\Http\Resources\SimpleUser;
use Illuminate\Http\Resources\Json\JsonResource;

class Article extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        
        return [
            'id' => $this->resource->id,
            'title' => $this->resource->title,
            'description' => $this->resource->description,
            'author' => new SimpleUser($this->resource->author),
            'status' => $this->resource->is_approved,
            'created_at' => $this->resource->created_at->diffForHumans(),
            'updated_at' => $this->resource->updated_at,
        ];
    }
}
