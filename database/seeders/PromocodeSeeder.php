<?php

namespace Database\Seeders;

use App\Models\Promocode;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PromocodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Promocode::create([
            'code' => 'AUR15',
            'discount' => 15,
            'active' => true,
            'uses' => 0,
            'max_uses' => null,
            'expires_at' => null,
        ]);

        Promocode::create([
            'code' => 'DEV99',
            'discount' => 90,
            'active' => true,
            'uses' => 0,
            'max_uses' => 0,
            'expires_at' => null,
        ]);
    }
}
