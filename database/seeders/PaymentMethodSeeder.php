<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PaymentMethod::create([
            'name_ru' => 'Наличные',
            'name_ro' => 'Cash',
            'active' => true,
        ]);

        PaymentMethod::create([
            'name_ru' => 'Онлайн оплата картой',
            'name_ro' => 'Achitare online',
            'active' => true,
        ]);
    }
}
