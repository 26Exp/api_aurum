<?php

namespace Database\Seeders;

use App\Models\AttributeValue;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AttributeValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AttributeValue::create([
            'attribute_id' => 2,
            'name_ru' => 'Золото',
            'name_ro' => 'Aur',
        ]);

        AttributeValue::create([
            'attribute_id' => 2,
            'name_ru' => 'Серебро',
            'name_ro' => 'Argint',
        ]);

        AttributeValue::create([
            'attribute_id' => 2,
            'name_ru' => 'Платина',
            'name_ro' => 'Platina',
        ]);

        AttributeValue::create([
            'attribute_id' => 2,
            'name_ru' => 'Бронза',
            'name_ro' => 'Bronza',
        ]);
    }
}
