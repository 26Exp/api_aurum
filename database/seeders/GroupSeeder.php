<?php

namespace Database\Seeders;

use App\Models\Group;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Group::create([
            'name_ru' => 'Подарки для неё',
            'name_ro' => 'Cadouri pentru ea',
            'description_ru' => 'Подарки для неё',
            'description_ro' => 'Cadouri pentru ea',
            'meta_title_ru' => 'Подарки для неё',
            'meta_title_ro' => 'Cadouri pentru ea',
            'meta_description_ru' => 'Подарки для неё',
            'meta_description_ro' => 'Cadouri pentru ea',
        ]);

        Group::create([
            'name_ru' => 'Подарки для него',
            'name_ro' => 'Cadouri pentru el',
            'description_ru' => 'Подарки для него',
            'description_ro' => 'Cadouri pentru el',
            'meta_title_ru' => 'Подарки для него',
            'meta_title_ro' => 'Cadouri pentru el',
            'meta_description_ru' => 'Подарки для него',
            'meta_description_ro' => 'Cadouri pentru el',
        ]);

        Group::create([
            'name_ru' => 'Подарки для детей',
            'name_ro' => 'Cadouri pentru copii',
            'description_ru' => 'Подарки для детей',
            'description_ro' => 'Cadouri pentru copii',
            'meta_title_ru' => 'Подарки для детей',
            'meta_title_ro' => 'Cadouri pentru copii',
            'meta_description_ru' => 'Подарки для детей',
            'meta_description_ro' => 'Cadouri pentru copii',
        ]);

        Group::create([
            'name_ru' => 'Подарки для родителей',
            'name_ro' => 'Cadouri pentru părinți',
            'description_ru' => 'Подарки для родителей',
            'description_ro' => 'Cadouri pentru părinți',
            'meta_title_ru' => 'Подарки для родителей',
            'meta_title_ro' => 'Cadouri pentru părinți',
            'meta_description_ru' => 'Подарки для родителей',
            'meta_description_ro' => 'Cadouri pentru părinți',
        ]);

        Group::create([
            'name_ru' => 'Подарки для братьев',
            'name_ro' => 'Cadouri pentru frați',
            'description_ru' => 'Подарки для братьев',
            'description_ro' => 'Cadouri pentru frați',
            'meta_title_ru' => 'Подарки для братьев',
            'meta_title_ro' => 'Cadouri pentru frați',
            'meta_description_ru' => 'Подарки для братьев',
            'meta_description_ro' => 'Cadouri pentru frați',
        ]);
    }
}
