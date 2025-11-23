<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'total' => 0,
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Order $order) {

            // cria entre 1 e 3 produtos (com category já automática via ProductFactory)
            $products = Product::factory()->count(rand(1, 3))->create();

            $total = 0;

            foreach ($products as $product) {

                $quantity = rand(1, 3);
                $subtotal = $product->price * $quantity;

                OrderItem::create([
                    'order_id'   => $order->id,
                    'product_id' => $product->id,
                    'quantity'   => $quantity,
                    'unit_price' => $product->price,
                ]);

                $total += $subtotal;
            }

            $order->update(['total' => $total]);
        });
    }
}
