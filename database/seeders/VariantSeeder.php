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
            'name' => 'Inel Din Aur size 16',
            'price' => 120,
            'stock' => 10,
            'sku' => 'AUR1',
        ]);

        Variant::create([
            'product_id' => 1,
            'name' => 'Din Argint size 17',
            'price' => 85,
            'stock' => 6,
            'sku' => 'ARG1',
        ]);

        Variant::create([
            'product_id' => 2,
            'name' => 'Cercei Aur ',
            'price' => 100,
            'stock' => 10,
            'sku' => 'AUR2',
        ]);

        Variant::create([
            'product_id' => 2,
            'name' => 'Cercei Argint',
            'price' => 75,
            'stock' => 6,
            'sku' => 'ARG2',
        ]);
    }
}
