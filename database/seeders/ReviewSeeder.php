<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Review;
use App\Models\User;
use App\Models\Product;

class ReviewSeeder extends Seeder
{
    public function run()
    {
        $users = User::where('role', 'customer')->get();
        $products = Product::all();

        // Create 100 reviews
        Review::factory(100)->create([
            'user_id' => fn() => $users->random()->id,
            'product_id' => fn() => $products->random()->id,
        ]);
    }
}