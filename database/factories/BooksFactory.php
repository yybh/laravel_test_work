<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/


$factory->define(\App\Model\Books::class, function (\Faker\Generator $faker) {
    return [
        'title' => '书名_'.$faker->numberBetween(10001,20000),
        'author' =>'作者_'.$faker->numberBetween(10001,20000),
        'isbn' => 'isbn_'.$faker->numberBetween(10001,20000),
        'num' => $faker->numberBetween(1,20),
        'location' => '位置_'.$faker->numberBetween(10001,20000),
        'borrow_num' => 0,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
    ];

});
