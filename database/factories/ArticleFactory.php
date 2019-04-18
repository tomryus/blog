<?php

use Faker\Generator as Faker;
use App\Model\Category;
use Illuminate\Support\Str;

$factory->define(App\Model\Article::class, function (Faker $faker) {
    //$filePath = storage_path('images');
    return [
        'title' => $faker->name,
        'slug'  => str_slug($faker->name,'-'),
        'image' => $faker->image('public/storage/images/article',400,300, null, false),
        'thumbnail' => $faker->image('public/storage/images/article',100,100, null, false),
        //'image' => "default_image.jpg",
        //'thumbnail' => "default_thumbnail.jpg",
        'content' => $faker->text,
        'short_description' =>$faker->word,
        'category_id' =>function(){
           return Category::all()->random();
        }
              
    ];
});
