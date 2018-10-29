<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\About
 *
 * @property int $id
 * @property string|null $content 内容
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\About whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\About whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\About whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\About whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class About extends Model
{
    protected $fillable = [ 'content' ];
}
