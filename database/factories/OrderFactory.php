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
            'total'   => 0, // será atualizado depois
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Order $order) {

            // Criar entre 1 e 3 itens
            $items = Product::inRandomOrder()
                ->take(rand(1, 3))
                ->get();

            $total = 0;

            foreach ($items as $product) {

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

            // Atualiza total correto
            $order->update(['total' => $total]);
        });
    }
}
