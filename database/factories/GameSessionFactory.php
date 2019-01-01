<?php

use Faker\Generator as Faker;


$factory->define(\App\GameSession::class, function (Faker $faker) {

$title = $faker->sentence(3);
$slug = str_slug($title);

    return [
        'title' => $title,
        'game' => $faker->word,
        'description' => $faker->sentence(6),
        'slug' => $slug,
        'created_at' => now(),
        'updated_at' => now(),
        'user_id' => function() {
            return factory(\App\User::class)->create()->id;
        },
    ];
});

