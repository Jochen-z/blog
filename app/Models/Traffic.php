<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Traffic
 *
 * @mixin \Eloquent
 */
class Traffic extends Model
{
    protected $fillable = [
        'total',
        'type'
    ];

    /**
     * PV 数据
     *
     * @param $query
     * @param int $dates
     * @return mixed
     */
    public function scopePv($query, int $dates = 7)
    {
        return $query->where('type', 'PV')->orderBy('created_at', 'desc')->take($dates)->get();
    }

    /**
     * UV 数据
     *
     * @param $query
     * @param int $dates
     * @return mixed
     */
    public function scopeUv($query, int $dates = 7)
    {
        return $query->where('type', 'UV')->orderBy('created_at', 'desc')->take($dates)->get();
    }
}
