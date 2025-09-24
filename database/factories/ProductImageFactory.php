<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductImageFactory extends Factory
{
    protected $model = \App\Models\ProductImage::class;

    public function definition()
    {
        return [
            'product_id' => \App\Models\Product::factory(),
            'image_path' => $this->faker->imageUrl(800, 600, 'products'),
            'alt_text' => $this->faker->sentence(4),
            'is_primary' => false,
            'sort_order' => $this->faker->numberBetween(0, 10),
        ];
    }

    public function primary()
    {
        return $this->state(function (array $attributes) {
            return [
                'is_primary' => true,
            ];
        });
    }
}