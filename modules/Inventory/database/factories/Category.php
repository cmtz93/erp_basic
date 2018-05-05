<?php
use Modules\Inventory\Models\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    return [
      'name' => $faker->name,
      'description' => $faker->text(),
      'cover' => $faker->imageUrl(),

    ];
});
