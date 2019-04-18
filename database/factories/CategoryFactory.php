<?php

use Faker\Generator as Faker;

$factory->define(App\Model\Category::class, function (Faker $faker) {
    $category  = $faker->unique()->word;
    return [
        'category_name'=>$category,
        'slug'=> Str::slug($category, '-'),
        

    ];
});
