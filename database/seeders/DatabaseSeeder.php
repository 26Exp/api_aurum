<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AdminUserSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(AttributeSeeder::class);
        $this->call(AttributeValueSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(ManufacturerSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(VariantSeeder::class);
        $this->call(VariationSeeder::class);
        $this->call(PageSeeder::class);
        $this->call(DeliveryMethodSeeder::class);
        $this->call(PromocodeSeeder::class);
        $this->call(PaymentMethodSeeder::class);
        $this->call(StoreSeeder::class);
        $this->call(UserAddressSeeder::class);
        $this->call(GroupSeeder::class);
        $this->call(GroupProductSeeder::class);
    }
}
