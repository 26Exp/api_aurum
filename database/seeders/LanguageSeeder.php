<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Language::create([
            'code' => 'ru',
            'name' => 'Русский',
        ]);

        Language::create([
            'code' => 'ro',
            'name' => 'Română',
        ]);
    }
}
