<?php

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Article;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 所有分类 ID 数组，如：[1,2,3,4]
        $cid = Category::all()->pluck('id')->toArray();

        // 获取 Faker 实例
        $faker = app(Faker\Generator::class);
        $articles = factory(Article::class)
            ->times(100)
            ->make()
            ->each(function ($article, $index) use ($cid, $faker) {
                // 文章分类
                $article->category_id = $faker->randomElement($cid);
            });

        // 将数据集合转换为数组，并插入到数据库中
        Article::insert($articles->toArray());
    }
}
