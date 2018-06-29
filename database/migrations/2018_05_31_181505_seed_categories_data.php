<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class SeedCategoriesData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $now = date('Y-m-d H:i:s');
        $categories = [
            [
                'name' => '后端',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => '数据库',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => '服务器端',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => '前端',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => '其他',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        DB::table('categories')->insert($categories);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('categories')->truncate();
    }
}
