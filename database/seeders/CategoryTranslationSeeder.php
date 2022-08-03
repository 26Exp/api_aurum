<?php

namespace Database\Seeders;

use App\Models\CategoryTranslation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryTranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CategoryTranslation::create([
            'category_id' => 1,
            'name' => 'Кольца',
            'locale' => 'ru',
            'slug' => 'kolca',
            'description' => 'Кольца из каменного камня',
            'meta_title' => 'Кольца из каменного камня',
            'meta_description' => 'Мета описание категории кольца из каменного камня',
        ]);
        CategoryTranslation::create([
            'category_id' => 1,
            'name' => 'Inele',
            'locale' => 'ro',
            'slug' => 'inele',
            'description' => 'Descriere categoria Inele',
            'meta_title' => 'Meta titlu categoria  Inele',
            'meta_description' => 'Meta descriere categoria Inele',
        ]);

        CategoryTranslation::create([
            'category_id' => 2,
            'name' => 'Серьги',
            'locale' => 'ru',
            'slug' => 'sergi',
            'description' => 'Описание категории серьги',
            'meta_title' => 'Мета заголовок категории серьги',
            'meta_description' => 'Мета описание категории серьги',
        ]);
        CategoryTranslation::create([
            'category_id' => 2,
            'name' => 'Cercei',
            'locale' => 'ro',
            'slug' => 'cercei',
            'description' => 'Descriere categoria Cercei',
            'meta_title' => 'Meta titlu categoria  Cercei',
            'meta_description' => 'Meta descriere categoria Cercei',
        ]);
    }
}
