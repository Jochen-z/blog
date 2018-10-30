<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Visitor
 *
 * @mixin \Eloquent
 * @property int $id
 * @property string $path
 * @property string $ip
 * @property string|null $location
 * @property string $agent
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Visitor whereAgent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Visitor whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Visitor whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Visitor whereIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Visitor whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Visitor wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Visitor whereUpdatedAt($value)
 */
class Visitor extends Model
{
    protected $fillable = [
        'path',
        'ip',
        'location',
        'agent'
    ];
}
