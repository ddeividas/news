<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(News::class, function (Faker $faker) {
    return [
        'author' => Str::random(10),
        'title' => "Jolanta Butkevičienė. Influencerių vendeta",
        'article' => Str::random(1500),
        'category_id' => rand(1, 3),
        'user_id' => rand(1, 3),
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
    ];
});
