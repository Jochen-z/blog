<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->index()->comment('文章标题');
            $table->text('excerpt')->comment('文章摘要');
            $table->string('slug')->nullable()->comment('SEO友好的URI');
            $table->longText('content')->nullable()->comment('文章内容');
            $table->integer('category_id')->unsigned()->unsigned()->comment('文章分类');
            $table->integer('read_count')->unsigned()->default(0)->comment('查看总数');
            $table->tinyInteger('status')->unsigned()->default(1)->comment('文章状态:1-公开;0-私密');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('articles');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
