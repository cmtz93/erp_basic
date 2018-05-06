<?php

namespace Modules\Inventory\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Inventory\Models\Attribute;
use Modules\Inventory\Models\Value;

class AttributeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (Attribute::all() as $m) {
            $m->forceDelete();
        }
        $Attribute = [
            [   
                'name'      => 'Color',
                'value_type'=> 'Select',
                'values'    => ['Blanco','Negro','Gris','Dorado'],
            ],
            [   
                'name'      => 'Talla',
                'value_type'=> 'Select',
                'values'    => ['XS','S','M','L','XL','XXL'],
            ],
            [   
                'name'      => 'Modelo',
                'value_type'=> 'Text',
                'values'    => null,
            ],
            [   
                'name'      => 'Medidas',
                'value_type'=> 'Text',
                'values'    => null,
            ],
        ];

        foreach ($Attribute as $values) {
            $a = Attribute::create(['name' => $values['name'], 'value_type' => $values['value_type'] ]);
            if (!is_null($values['values'])) {
                foreach ($values['values'] as $value) {
                    $a->values()->save(new Value(['value' => $value]));
                }
            }
        }
    }
}
