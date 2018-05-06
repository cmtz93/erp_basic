<?php

namespace Modules\Inventory\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Inventory\Models\Status;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (Status::all() as $m) {
            $m->forceDelete();
        }
        $Status = [
            ['name' => 'Inactivo'],
            ['name' => 'Activo'],
            ['name' => 'En stock'],
            ['name' => 'Agotado'],
            ['name' => 'Pre-Order'],
            ['name' => 'Reservar'],
        ];

        foreach ($Status as $values) {
            Status::firstOrCreate($values);
        }
    }
}
