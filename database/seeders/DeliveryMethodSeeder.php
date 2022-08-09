<?php

namespace Database\Seeders;

use App\Models\DeliveryMethod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DeliveryMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DeliveryMethod::create([
            'name_ru' => 'Самовывоз',
            'name_ro' => 'Ridicarea din magazin',
            'description_ru' => 'Самовывоз из магазина',
            'description_ro' => 'Ridicarea produsului direct din magazin',
            'price' => 0
        ]);

        DeliveryMethod::create([
            'name_ru' => 'Доставка курьером',
            'name_ro' => 'Livrarea prin curier',
            'description_ru' => 'Доставка курьером',
            'description_ro' => 'Liberarea produsului prin curier',
            'price' => 100
        ]);
    }
}
