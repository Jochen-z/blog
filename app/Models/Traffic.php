<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Traffic
 *
 * @mixin \Eloquent
 * @property int $id
 * @property int $total
 * @property string $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Traffic newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Traffic newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Traffic pv($dates = 7)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Traffic query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Traffic uv($dates = 7)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Traffic whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Traffic whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Traffic whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Traffic whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Traffic whereUpdatedAt($value)
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
