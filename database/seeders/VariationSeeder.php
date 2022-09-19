<?php

namespace Database\Seeders;

use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Variation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VariationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Variation::create([
            'variant_id' => 1,
            'product_id' => 1,
            'attribute_id' => Attribute::MATERIAL,
            'attribute_value_id' => AttributeValue::GOLD,
        ]);

        Variation::create([
            'variant_id' => 1,
            'product_id' => 1,
            'attribute_id' => Attribute::SIZE,
            'attribute_value_id' => 5,
        ]);

        Variation::create([
            'product_id' => 1,
            'attribute_id' => Attribute::MATERIAL,
            'attribute_value_id' => AttributeValue::SILVER,
            'variant_id' => 2,
        ]);

        Variation::create([
            'product_id' => 1,
            'attribute_id' => Attribute::SIZE,
            'attribute_value_id' => 6,
            'variant_id' => 2,
        ]);


        Variation::create([
            'product_id' => 2,
            'attribute_id' => Attribute::MATERIAL,
            'attribute_value_id' => AttributeValue::GOLD,
            'variant_id' => 3,
        ]);

        Variation::create([
            'product_id' => 2,
            'attribute_id' => Attribute::MATERIAL,
            'attribute_value_id' => AttributeValue::SILVER,
            'variant_id' => 4,
        ]);
    }
}
