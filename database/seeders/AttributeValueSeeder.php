<?php

namespace Database\Seeders;

use App\Models\Attribute;
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
            'attribute_id' => Attribute::MATERIAL,
            'name_ru' => 'Золото',
            'name_ro' => 'Aur',
        ]);

        AttributeValue::create([
            'attribute_id' => Attribute::MATERIAL,
            'name_ru' => 'Серебро',
            'name_ro' => 'Argint',
        ]);

        AttributeValue::create([
            'attribute_id' => Attribute::MATERIAL,
            'name_ru' => 'Платина',
            'name_ro' => 'Platinum',
        ]);

        AttributeValue::create([
            'attribute_id' => Attribute::MATERIAL,
            'name_ru' => 'Бронза',
            'name_ro' => 'Bronze',
        ]);

        AttributeValue::create([
            'attribute_id' => Attribute::SIZE,
            'name_ru' => 16,
            'name_ro' => 16,
        ]);

        AttributeValue::create([
            'attribute_id' => Attribute::SIZE,
            'name_ru' => 17,
            'name_ro' => 17,
        ]);

        AttributeValue::create([
            'attribute_id' => Attribute::SIZE,
            'name_ru' => 18,
            'name_ro' => 18,
        ]);

    }
}
