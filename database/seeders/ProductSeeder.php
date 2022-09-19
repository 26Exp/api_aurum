<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'category_id' => 1,
            'manufacturer_id' => 1,
            'name_ro' => 'Inel cu piatra naturala',
            'name_ru' => 'Кольцо с натуральным камнем',
            'description_ru' => 'Кольцо с натуральным камнем из серебра ili золота',
            'description_ro' => 'Inel cu piatra naturala din argint sau aur',
            'meta_title_ru' => 'Кольцо с натуральным камнем',
            'meta_description_ru' => 'Кольцо с натуральным камнем из серебра ili золота',
            'meta_title_ro' => 'Inel cu piatra naturala',
            'meta_description_ro' => 'Inel cu piatra naturala din argint sau aur',
            'out_of_stock_text_ro' => 'Stoc epuizat',
            'out_of_stock_text_ru' => 'Нет в наличии',
            'has_custom_msg' => false,
            'has_discount' => false,
            'has_badge' => false,
            'status' => Product::STATUS_PUBLISHED,
        ]);

        Product::create([
            'category_id' => 2,
            'manufacturer_id' => 1,
            'name_ro' => 'Cercei cu piatra naturala',
            'name_ru' => 'Серьги с натуральным камнем',
            'description_ru' => 'Серьги с натуральным камнем из серебра ili золота',
            'description_ro' => 'Cercei cu piatra naturala din argint sau aur',
            'meta_title_ru' => 'Серьги с натуральным камнем',
            'meta_description_ru' => 'Серьги с натуральным камнем из серебра ili золота',
            'meta_title_ro' => 'Cercei cu piatra naturala',
            'meta_description_ro' => 'Cercei cu piatra naturala din argint sau aur',
            'out_of_stock_text_ro' => 'Stoc epuizat',
            'out_of_stock_text_ru' => 'Нет в наличии',
            'has_custom_msg' => false,
            'has_discount' => false,
            'has_badge' => false,
            'status' => Product::STATUS_PUBLISHED,
        ]);
    }
}
