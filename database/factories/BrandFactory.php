<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BrandFactory extends Factory
{
    protected $model = \App\Models\Brand::class;

    public function definition()
    {
        $name = $this->faker->company();
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => $this->faker->paragraph(),
            'logo' => $this->faker->imageUrl(200, 100, 'business'),
            'website' => $this->faker->url(),
            'is_active' => $this->faker->boolean(90),
        ];
    }
}