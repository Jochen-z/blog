<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_tags', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('article_id')->nullable(false)->unsigned()->index()->comment('文章ID');
            $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
            $table->integer('tag_id')->nullable(false)->unsigned()->index()->comment('标签ID');
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('article_tags');
    }
}
