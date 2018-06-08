<?php

use Illuminate\Database\Seeder;
use App\Models\Article;
use App\Models\Tag;

class ArticleTagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 生成标签
        factory(Tag::class, 20)->create();

        // 生成关联数据
        $tags = Tag::all();

        // Populate the pivot table
        Article::all()->each(function ($article) use ($tags) {
            $article->tags()->attach(
                $tags->random(rand(0, 3))->pluck('id')->toArray()
            );
        });
    }
}
