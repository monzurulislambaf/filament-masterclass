<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    protected $model = \App\Models\Product::class;

    public function definition()
    {
        $name = $this->faker->sentence(3);
        $price = $this->faker->randomFloat(2, 10, 1000);
        return [
            'name' => rtrim($name, '.'),
            'slug' => Str::slug($name),
            'sku' => 'SKU-' . strtoupper(Str::random(6)),
            'description' => $this->faker->paragraph(3),
            'short_description' => $this->faker->sentence(),
            'price' => $price,
            'compare_price' => $this->faker->optional()->randomElement([
                $price * 1.2,
                $price * 1.5,
                null
            ]),
            'cost_per_item' => $price * 0.7,
            'quantity' => $this->faker->numberBetween(0, 1000),
            'weight' => $this->faker->randomFloat(2, 0.1, 50),
            'dimensions' => $this->faker->optional()->randomElement([
                '10x5x3 cm',
                '20x15x10 cm',
                null
            ]),
            'category_id' => \App\Models\Category::factory(),
            'brand_id' => \App\Models\Brand::factory(),
            'is_featured' => $this->faker->boolean(20),
            'is_active' => $this->faker->boolean(95),
            'meta_title' => $this->faker->sentence(6),
            'meta_description' => $this->faker->sentence(15),
        ];
    }
}