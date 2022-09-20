<?php

namespace Database\Seeders;

use App\Models\GroupProduct;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GroupProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        GroupProduct::create([
            'group_id' => 1,
            'product_id' => 1,
        ]);

        GroupProduct::create([
            'group_id' => 1,
            'product_id' => 2,
        ]);
    }
}
