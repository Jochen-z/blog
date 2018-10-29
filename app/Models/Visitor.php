<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Visitor
 *
 * @mixin \Eloquent
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
