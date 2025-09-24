<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class, // Users first for orders
            CategorySeeder::class, // Categories before products
            BrandSeeder::class, // Brands before products
            ProductSeeder::class, // Products before orders
            CouponSeeder::class, // Coupons before orders
            OrderSeeder::class, // Orders after all products
            ReviewSeeder::class, // Reviews after orders
        ]);
    }
}