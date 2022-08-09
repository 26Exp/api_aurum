<?php

namespace Database\Seeders;

use App\Models\Attribute;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Attribute::create([
            'name_ru' => 'Размер',
            'name_ro' => 'Mărime',
            'slug_ru' => 'razmer',
            'slug_ro' => 'marime',
            'is_filterable' => true,
        ]);

        Attribute::create([
            'name_ru' => 'Тип метала',
            'name_ro' => 'Tip metal',
            'slug_ru' => 'tip-metal',
            'slug_ro' => 'tip-metal',
            'is_filterable' => true,
        ]);
    }
}
