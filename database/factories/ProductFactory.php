<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {


    return [
        'category_id' => function () {
            return factory(App\Models\Category::class)->create()->id;
        },
        'name' => $faker->name,
        'image' => $faker->url
    ];
});
