<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use App\Models\Product;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        $products = Product::all();
        $statuses = ['pending', 'processing', 'completed', 'cancelled', 'refunded'];

        // Create orders over the last 30 days
        $orderDates = collect(range(0, 30))->map(function ($daysAgo) {
            return now()->subDays($daysAgo);
        });

        $orderDates->each(function ($date) use ($users, $products, $statuses) {
            // Create 1-5 orders per day
            $ordersToday = rand(1, 5);
            
            for ($i = 0; $i < $ordersToday; $i++) {
                $order = Order::create([
                    'user_id' => $users->random()->id,
                    'order_number' => 'ORD-' . strtoupper(uniqid()),
                    'status' => $statuses[array_rand($statuses)],
                    'currency' => 'USD',
                    'subtotal' => 0,
                    'tax_amount' => 0,
                    'shipping_amount' => 1000, // $10 shipping
                    'discount_amount' => 0,
                    'total_amount' => 0, // Will be updated after adding items
                    'payment_status' => 'paid',
                    'payment_method' => 'credit_card',
                    'shipping_address' => json_encode([
                        'address' => fake()->streetAddress(),
                        'city' => fake()->city(),
                        'state' => fake()->state(),
                        'country' => 'US',
                        'postal_code' => fake()->postcode(),
                    ]),
                    'billing_address' => json_encode([
                        'address' => fake()->streetAddress(),
                        'city' => fake()->city(),
                        'state' => fake()->state(),
                        'country' => 'US',
                        'postal_code' => fake()->postcode(),
                    ]),
                    'notes' => fake()->optional()->sentence(),
                    'created_at' => $date,
                    'updated_at' => $date,
                ]);

                // Add 1-5 items to the order
                $orderProducts = $products->random(rand(1, 5));
                
                foreach ($orderProducts as $product) {
                    $quantity = rand(1, 3);
                    $price = $product->price;
                    $total = $price * $quantity;

                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $product->id,
                        'name' => $product->name,
                        'sku' => $product->sku,
                        'quantity' => $quantity,
                        'price' => $price,
                        'total' => $total,
                    ]);

                    // Update order totals
                    $order->increment('subtotal', $total);

                    // After all items are added, update the total_amount
                    $order->update([
                        'total_amount' => $order->subtotal + $order->shipping_amount - $order->discount_amount,
                    ]);
                }
            }
        });
    }
}