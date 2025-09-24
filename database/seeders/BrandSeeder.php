<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brand;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        $brands = [
            [
                'name' => 'Apple',
                'slug' => 'apple',
                'description' => 'Premium electronics and technology products',
                'website' => 'https://apple.com',
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'name' => 'Samsung',
                'slug' => 'samsung',
                'description' => 'Electronics, home appliances, and mobile devices',
                'website' => 'https://samsung.com',
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'name' => 'Nike',
                'slug' => 'nike',
                'description' => 'Athletic footwear, apparel, and accessories',
                'website' => 'https://nike.com',
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'name' => 'Adidas',
                'slug' => 'adidas',
                'description' => 'Sports clothing, shoes, and equipment',
                'website' => 'https://adidas.com',
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'name' => 'Sony',
                'slug' => 'sony',
                'description' => 'Consumer electronics and entertainment',
                'website' => 'https://sony.com',
                'is_featured' => false,
                'is_active' => true,
            ],
            [
                'name' => 'Canon',
                'slug' => 'canon',
                'description' => 'Professional cameras and imaging solutions',
                'website' => 'https://canon.com',
                'is_featured' => false,
                'is_active' => true,
            ],
            [
                'name' => 'LG',
                'slug' => 'lg',
                'description' => 'Electronics and home appliances',
                'website' => 'https://lg.com',
                'is_featured' => false,
                'is_active' => true,
            ],
            [
                'name' => 'Bose',
                'slug' => 'bose',
                'description' => 'Premium audio equipment and accessories',
                'website' => 'https://bose.com',
                'is_featured' => false,
                'is_active' => true,
            ],
        ];

        foreach ($brands as $brand) {
            Brand::create($brand);
        }
    }
}