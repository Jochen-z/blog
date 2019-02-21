<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\OperationLog
 *
 * @mixin \Eloquent
 * @property int $id
 * @property string $path
 * @property string $ip
 * @property string|null $location
 * @property string $agent
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OperationLog whereAgent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OperationLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OperationLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OperationLog whereIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OperationLog whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OperationLog wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OperationLog whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OperationLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OperationLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OperationLog query()
 */
class OperationLog extends Model
{
    protected $table = 'operation_log';

    protected $fillable = [
        'path',
        'username',
        'ip',
        'location',
        'agent'
    ];
}
