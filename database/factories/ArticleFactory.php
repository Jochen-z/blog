<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Article::class, function (Faker $faker) {

    $sentence = $faker->sentence();
    $time = $faker->dateTimeThisMonth();

    return [
        'title'      => $sentence,
        'content'    => $faker->text(),
        'excerpt'    => $sentence,
        'created_at' => $time,
        'updated_at' => $time,
    ];
});
