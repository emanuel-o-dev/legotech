<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductControllerTestFinish extends TestCase
{
    use RefreshDatabase;

    /**
     * Finishes checkout and creates an order.
     *
     * @return void
     */
    public function testItFinishesCheckoutAndCreatesOrder(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $product = Product::factory()->create([
            'price' => 20,
        ]);
        $this->withSession([
            'cart' => [
                $product->id => [
                    'id' => $product->id,
                    'name' => $product->name,
                    'price' => 20,
                    'quantity' => 3,
                ],
            ]
        ]);

        $response = $this->post('/checkout/finish');

        $this->assertDatabaseHas('orders', [
            'user_id' => $user->id,
            'total' => 60, // 20 * 3
        ]);

        $this->assertDatabaseHas('order_items', [
            'product_id' => 1,
            'unit_price' => 20,
            'quantity' => 3,
        ]);

        $response->assertSessionHas('success');

        $this->assertNull(session('cart'));
    }
}
