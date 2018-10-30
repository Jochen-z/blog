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
}
