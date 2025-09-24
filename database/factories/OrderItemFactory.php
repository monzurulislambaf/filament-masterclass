<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class OrderItemFactory extends Factory
{
    protected $model = \App\Models\OrderItem::class;

    public function definition()
    {
        $product = \App\Models\Product::factory()->create();
        $quantity = $this->faker->numberBetween(1, 5);
        $price = $product->price;
        $total = $price * $quantity;

        return [
            'order_id' => \App\Models\Order::factory(),
            'product_id' => $product->id,
            'product_variant_id' => null,
            'name' => $product->name,
            'sku' => $product->sku,
            'quantity' => $quantity,
            'price' => $price,
            'total' => $total,
        ];
    }
}