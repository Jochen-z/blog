<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class ArticleResource extends Resource
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
            'id'            => $this->id,
            'title'         => $this->title,
            'excerpt'       => $this->excerpt,
            'slug'          => $this->slug,
            'content'       => $this->content,
            'category_id'   => $this->category_id,
            'category_name' => $this->whenLoaded('category')['name'],
            'read_count'    => $this->read_count,
            'status'        => $this->status,
            'tag'           => TagResource::collection($this->whenLoaded('tags')),
            'created_at'    => optional($this->created_at)->toDateTimeString(),
            'updated_at'    => optional($this->updated_at)->toDateTimeString(),
        ];
    }
}
