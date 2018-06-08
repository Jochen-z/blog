<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\ArticleTag::class, function (Faker $faker) {

    $time = $faker->dateTimeThisYear();

    return [
        'created_at' => $time,
        'updated_at' => $time,
    ];
});
