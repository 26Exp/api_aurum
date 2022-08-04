<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name_ru' => 'Украшения',
            'name_ro' => 'Accesorii',
            'slug_ru' => 'ukrasheniya',
            'slug_ro' => 'accesorii',
            'description_ru' => 'Украшения',
            'description_ro' => 'Accesorii',
            'meta_title_ru' => 'Украшения',
            'meta_title_ro' => 'Accesorii',
            'meta_description_ru' => 'Украшения',
            'meta_description_ro' => 'Accesorii',
            'parent_id' => null,
        ]);

        Category::create([
            'name_ru' => 'Серьги',
            'name_ro' => 'Cercei',
            'slug_ru' => 'sergi',
            'slug_ro' => 'cercei',
            'description_ru' => 'Серьги',
            'description_ro' => 'Cercei',
            'meta_title_ru' => 'Серьги',
            'meta_title_ro' => 'Cercei',
            'meta_description_ru' => 'Серьги',
            'meta_description_ro' => 'Cercei',
            'parent_id' => 1,
        ]);

        Category::create([
            'name_ru' => 'Кольца',
            'name_ro' => 'Inele',
            'slug_ru' => 'kolci',
            'slug_ro' => 'inele',
            'description_ru' => 'Кольца',
            'description_ro' => 'Inele',
            'meta_title_ru' => 'Кольца',
            'meta_title_ro' => 'Inele',
            'meta_description_ru' => 'Кольца',
            'meta_description_ro' => 'Inele',
            'parent_id' => 1,
        ]);
    }
}
