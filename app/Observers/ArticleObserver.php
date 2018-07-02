<?php

namespace App\Observers;

use App\Models\Article;
use App\Tools\SlugTranslateHandler;

class ArticleObserver
{
    /**
     * 每分钟阅读速度
     */
    const PER_MINUTE = 300;

    public function saving(Article $article)
    {
        // 统计字数
        $article->word_count = countWords($article->content);
        // 统计阅读时间
        $article->read_time = ceil($article->word_count / self::PER_MINUTE);
        // 生成 Slug
        if (! $article->slug) {
            // 使用翻译器对 title 进行翻译
            $article->slug = app(SlugTranslateHandler::class)->translate($article->title);
        }
    }
}