<?php
use Modules\Inventory\Models\Manufacturer;
use Faker\Generator as Faker;

$factory->define(Manufacturer::class, function (Faker $faker) {
    return [
      'name' 				=> $faker->name,
      'description' => $faker->text(),
      'quality' 		=> rand(1,5),
      'cover'				=> $faker->imageUrl(),

    ];
});
