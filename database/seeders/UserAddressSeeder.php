<?php

namespace Database\Seeders;

use App\Models\UserAddress;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserAddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserAddress::create([
            'user_id' => 1,
            'first_name' => 'John',
            'last_name' => 'Doe',
            'country' => 'Ukraine',
            'address' => 'Ukraine, Kiev',
            'city' => 'Kiev',
            'zip' => '01001',
            'email' => 'a@ya.ru',
            'notes' => 'Some notes',
            'is_default' => true,
        ]);
    }
}
