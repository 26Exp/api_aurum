<?php

namespace Database\Seeders;

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
            'product_id' => 1,
            'attribute_id' => 1,
            'attribute_value_id' => 1,
            'variant_id' => 1,
        ]);

        Variation::create([
            'product_id' => 1,
            'attribute_id' => 1,
            'attribute_value_id' => 2,
            'variant_id' => 1,
        ]);
    }
}
