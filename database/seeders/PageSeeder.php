<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Page::create([
            'title_ru' => 'Главная',
            'title_ro' => 'Home',
            'content_ru' => '<p>Главная страница</p>',
            'content_ro' => '<p>Home page</p>',
            'meta_title_ru' => 'Главная',
            'meta_title_ro' => 'Home',
            'meta_description_ru' => 'Главная страница',
            'meta_description_ro' => 'Home page',
        ]);

        Page::create([
            'title_ru' => 'Политика конфиденциальности',
            'title_ro' => 'Privacy policy',
            'content_ru' => '<p>Политика конфиденциальности</p>',
            'content_ro' => '<p>Privacy policy</p>',
            'meta_title_ru' => 'Политика конфиденциальности',
            'meta_title_ro' => 'Privacy policy',
            'meta_description_ru' => 'Политика конфиденциальности',
            'meta_description_ro' => 'Privacy policy',
        ]);
    }
}
