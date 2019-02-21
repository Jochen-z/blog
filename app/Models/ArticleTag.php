<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ArticleTag
 *
 * @property int $id
 * @property int $article_id 文章ID
 * @property int $tag_id 标签ID
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ArticleTag whereArticleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ArticleTag whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ArticleTag whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ArticleTag whereTagId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ArticleTag whereUpdatedAt($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ArticleTag newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ArticleTag newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ArticleTag query()
 */
class ArticleTag extends Model
{
    protected $fillable = ['article_id', 'tag_id'];
}
