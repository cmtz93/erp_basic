<?php

namespace Modules\Inventory\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Inventory\Models\Category;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        factory(Category::class, 6)->create()->each(function ($c) {
            factory(Category::class, 10)->create([
                'category_id' => $c->id
                ]);
        });
    }
}
