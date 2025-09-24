<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Coupon;

class CouponSeeder extends Seeder
{
    public function run(): void
    {
        $coupons = [
            [
                'code' => 'WELCOME10',
                'type' => 'percentage',
                'value' => 10,
                'minimum_amount' => 5000, // $50
                'description' => '10% off on orders over $50',
                'starts_at' => now(),
                'expires_at' => now()->addMonths(3),
                'max_uses' => 1000,
                'max_uses_per_user' => 1,
                'is_active' => true,
            ],
            [
                'code' => 'SAVE20',
                'type' => 'percentage',
                'value' => 20,
                'minimum_amount' => 10000, // $100
                'description' => '20% off on orders over $100',
                'starts_at' => now(),
                'expires_at' => now()->addDays(30),
                'max_uses' => 500,
                'max_uses_per_user' => 1,
                'is_active' => true,
            ],
            [
                'code' => 'FREESHIP',
                'type' => 'fixed_amount',
                'value' => 1000, // $10 for shipping
                'description' => 'Free shipping on all orders',
                'starts_at' => now(),
                'expires_at' => now()->addYear(),
                'max_uses' => null,
                'max_uses_per_user' => null,
                'is_active' => true,
            ],
            [
                'code' => 'NEWUSER',
                'type' => 'fixed_amount',
                'value' => 1500, // $15
                'description' => '$15 off for new users',
                'starts_at' => now(),
                'expires_at' => null,
                'max_uses' => null,
                'max_uses_per_user' => 1,
                'is_active' => true,
            ],
        ];

        foreach ($coupons as $coupon) {
            Coupon::create($coupon);
        }
    }
}