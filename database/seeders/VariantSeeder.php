<?php

namespace Database\Seeders;

use App\Models\Variant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VariantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Variant::create([
            'product_id' => 1,
            'attribute_id' => 1,
            'attribute_value_id' => 1,
            'price' => 10,
            'stock' => 10,
            'sku' => 'AUR1',
        ]);

        Variant::create([
            'product_id' => 1,
            'attribute_id' => 1,
            'attribute_value_id' => 2,
            'price' => 10,
            'stock' => 10,
            'sku' => 'AUR2',
        ]);
    }
}
