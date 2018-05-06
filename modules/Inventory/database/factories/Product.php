<?php
use Modules\Inventory\Models\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
      'name' => $faker->name,
      'description' => $faker->text(),
      'cover' => $faker->imageUrl(),
    	'barcode' => $faker->ean13,
    	'sku' => $faker->numberBetween($min = 13987490, $max = 99987490),
	    'category_id' => function () {
        return factory(Modules\Inventory\Models\Category::class)->create()->id;
      },
	    'manufacturer_id' => function () {
        return factory(Modules\Inventory\Models\Manufacturer::class)->create()->id;
      },
      'status_id' => function () {
        return Modules\Inventory\Models\Status::inRandomOrder()->first()->id;
      },
    ];
});
