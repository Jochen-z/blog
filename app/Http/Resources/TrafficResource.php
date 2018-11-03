<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class TrafficResource extends Resource
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
            'total' => $this->total,
            'created_at' => $this->created_at->format('j/n')
        ];
    }
}
