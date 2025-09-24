<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Category;
use App\Models\Brand;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $brands = Brand::all()->keyBy('slug');
        $categories = Category::all()->keyBy('slug');
        
        // Electronics Products
        $this->createProduct([
            'name' => 'iPhone 14 Pro',
            'slug' => 'iphone-14-pro',
            'sku' => 'APPL-IP14PRO',
            'description' => 'The latest iPhone with advanced camera system',
            'price' => 99900,
            'brand_id' => $brands['apple']->id,
            'category_id' => $categories['smartphones']->id,
            'is_featured' => true,
            'is_active' => true,
        ]);

        $this->createProduct([
            'name' => 'Samsung Galaxy S23 Ultra',
            'slug' => 'samsung-galaxy-s23-ultra',
            'sku' => 'SMSNG-S23U',
            'description' => 'Premium Android smartphone with S Pen',
            'price' => 119900,
            'brand_id' => $brands['samsung']->id,
            'category_id' => $categories['smartphones']->id,
            'is_featured' => true,
            'is_active' => true,
        ]);

        // Fashion Products
        $this->createProduct([
            'name' => 'Nike Air Max 270',
            'slug' => 'nike-air-max-270',
            'sku' => 'NIKE-AM270',
            'description' => 'Iconic Air Max sneakers for maximum comfort',
            'price' => 15000,
            'brand_id' => $brands['nike']->id,
            'category_id' => $categories['mens-clothing']->id,
            'is_featured' => true,
            'is_active' => true,
        ]);

        $this->createProduct([
            'name' => 'Adidas Ultraboost',
            'slug' => 'adidas-ultraboost',
            'sku' => 'ADAS-UBST',
            'description' => 'Premium running shoes with Boost technology',
            'price' => 18000,
            'brand_id' => $brands['adidas']->id,
            'category_id' => $categories['mens-clothing']->id,
            'is_featured' => false,
            'is_active' => true,
        ]);

        // Create more random products
        $categories->each(function ($category) use ($brands) {
            Product::factory(3)->create([
                'category_id' => $category->id,
                'brand_id' => $brands->random()->id,
                'sku' => function () {
                    return strtoupper(substr(uniqid(), -8));
                },
            ])->each(function ($product) {
                $this->createProductImages($product);
            });
        });
    }

    private function createProduct(array $data): void
    {
        $product = Product::create($data);
        $this->createProductImages($product);
    }

    private function createProductImages($product): void
    {
        ProductImage::factory(3)->create([
            'product_id' => $product->id,
        ]);
            
        $product->images()->first()->update(['is_primary' => true]);
    }
}