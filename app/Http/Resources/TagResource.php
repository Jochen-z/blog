<?php

namespace App\Http\Resources;

use App\Models\ArticleTag;
use Illuminate\Http\Resources\Json\Resource;

class TagResource extends Resource
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
            'id'         => $this->id,
            'name'       => $this->name,
            'sum'        => $this->when($this->isIndex(), ArticleTag::where('tag_id', $this->id)->count()),
            'created_at' => optional($this->created_at)->toDateTimeString(),
            'updated_at' => optional($this->updated_at)->toDateTimeString(),
        ];
    }

    /**
     * @return bool
     */
    protected function isIndex()
    {
        return currentAction()['method'] == 'index';
    }
}
