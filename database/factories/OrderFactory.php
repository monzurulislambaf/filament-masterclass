<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    protected $model = \App\Models\Order::class;

    public function definition()
    {
        $subtotal = $this->faker->randomFloat(2, 50, 1000);
        $tax = $subtotal * 0.1;
        $shipping = $this->faker->randomElement([0, 5.99, 9.99, 15.99]);
        $discount = $this->faker->optional()->randomFloat(2, 0, $subtotal * 0.3);
        $total = $subtotal + $tax + $shipping - $discount;

        return [
            'user_id' => \App\Models\User::factory(),
            'order_number' => 'ORD-' . strtoupper($this->faker->bothify('???###')),
            'status' => $this->faker->randomElement(['pending', 'processing', 'shipped', 'delivered', 'cancelled']),
            'currency' => 'USD',
            'subtotal' => $subtotal,
            'tax_amount' => $tax,
            'shipping_amount' => $shipping,
            'discount_amount' => $discount,
            'total_amount' => $total,
            'payment_status' => $this->faker->randomElement(['pending', 'paid', 'failed', 'refunded']),
            'payment_method' => $this->faker->randomElement(['credit_card', 'paypal', 'bank_transfer']),
            'shipping_address' => [
                'name' => $this->faker->name(),
                'address' => $this->faker->streetAddress(),
                'city' => $this->faker->city(),
                'state' => $this->faker->state(),
                'zip' => $this->faker->postcode(),
                'country' => $this->faker->country(),
            ],
            'billing_address' => [
                'name' => $this->faker->name(),
                'address' => $this->faker->streetAddress(),
                'city' => $this->faker->city(),
                'state' => $this->faker->state(),
                'zip' => $this->faker->postcode(),
                'country' => $this->faker->country(),
            ],
            'notes' => $this->faker->optional()->sentence(),
        ];
    }
}