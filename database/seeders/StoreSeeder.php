<?php

namespace Database\Seeders;

use App\Models\Store;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Store::create([
            'name' => 'Bălți — str. Independenței, 12',
            'latitude' => '47.76068884404603',
            'longitude' => '27.92691577104401',
        ]);
        Store::create([
            'name' => 'Bălți — str. Ștefan cel Mare, 41',
            'latitude' => '47.76155826986343',
            'longitude' => '27.926256192526974',
        ]);
        Store::create([
            'name' => 'Ungheni — str. Națională, 17',
            'latitude' => '47.208305827735195',
            'longitude' => '27.80160436896967',
        ]);
        Store::create([
            'name' => 'Edineț — str. Mihai Eminescu, 1b',
            'latitude' => '48.168742772797955',
            'longitude' => '27.307183035310924',
        ]);
    }
}
