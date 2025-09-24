<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CouponFactory extends Factory
{
    protected $model = \App\Models\Coupon::class;

    public function definition()
    {
        $type = $this->faker->randomElement(['percentage', 'fixed_amount']);
        $value = $type === 'percentage' 
            ? $this->faker->numberBetween(5, 50) 
            : $this->faker->randomFloat(2, 5, 100);

        return [
            'code' => strtoupper($this->faker->bothify('???###')),
            'type' => $type,
            'value' => $value,
            'minimum_amount' => $this->faker->optional()->randomFloat(2, 20, 200),
            'maximum_discount' => $type === 'percentage' ? $this->faker->optional()->randomFloat(2, 10, 200) : null,
            'usage_limit' => $this->faker->optional()->numberBetween(1, 100),
            'used_count' => 0,
            'starts_at' => $this->faker->optional()->dateTimeBetween('-1 month', 'now'),
            'expires_at' => $this->faker->optional()->dateTimeBetween('now', '+3 months'),
            'is_active' => $this->faker->boolean(90),
        ];
    }
}