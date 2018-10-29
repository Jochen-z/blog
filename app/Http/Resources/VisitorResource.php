<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class VisitorResource extends Resource
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
            'path'       => $this->path,
            'ip'         => $this->ip,
            'location'   => $this->location,
            'agent'      => $this->agent,
            'created_at' => optional($this->created_at)->toDateTimeString(),
            'updated_at' => optional($this->updated_at)->toDateTimeString(),
        ];
    }
}
