<?php

namespace App\Models;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Article
 *
 * @property int $id
 * @property string $title 文章标题
 * @property string $excerpt 文章摘要
 * @property string|null $slug SEO友好的URI
 * @property string|null $content 文章内容
 * @property int $category_id 文章分类
 * @property int $read_count 查看总数
 * @property int $read_time 阅读时间
 * @property int $word_count 字数统计
 * @property int $status 文章状态:0-私密;1-公开
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\Models\Category $category
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Tag[] $tags
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article recent()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereExcerpt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereReadCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article search($title)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereReadTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereWordCount($value)
 * @mixin \Eloquent
 */
class Article extends Model
{
    use Searchable;

    protected $fillable = [
        'title',
        'excerpt',
        'slug',
        'content',
        'category_id',
        'word_count',
        'read_time',
        'status',
    ];

    /**
     * 使用 Slug 作为 URL
     *
     * @param array $params
     * @return string
     */
    public function link($params = [])
    {
        return route('articles.show', array_merge([$this->id, $this->slug], $params));
    }

    /**
     * 限制查询按创建时间排序
     *
     * @param $query
     * @return mixed
     */
    public function scopeRecent($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    /**
     * 模糊查询标题
     *
     * @param $query
     * @param $title
     * @return mixed
     */
    public function scopeSearch($query, $title)
    {
        return $query->where('title', 'like', '%' . $title . '%');
    }

    /**
     * 获取关联分类
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * 获取所有关联标签
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'article_tags');
    }

    /**
     * 索引的字段
     *
     * @return array
     */
    public function toSearchableArray()
    {
        return $this->only([
            'id',
            'title',
            'excerpt',
            'content'
        ]);
    }
}
