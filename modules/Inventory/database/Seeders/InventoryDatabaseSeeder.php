<?php

namespace Modules\Inventory\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class InventoryDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CategoryTableSeeder::class,
            StatusTableSeeder::class,
            ManufacturerTableSeeder::class,
            AttributeTableSeeder::class,
            ProductTableSeeder::class,

        ]);
    }
}
