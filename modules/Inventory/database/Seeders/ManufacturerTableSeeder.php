<?php

namespace Modules\Inventory\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Inventory\Models\Manufacturer;

class ManufacturerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (Manufacturer::all() as $m) {
            $m->forceDelete();
        }
        factory(Manufacturer::class, rand(30,70))->make();
    }
}
