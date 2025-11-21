<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CheckoutControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_finishes_checkout_and_creates_order()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $this->withSession([
            'cart' => [
                1 => [
                    'id' => 1,
                    'name' => 'Produto X',
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

        $response->assertSessionHas('success', 'Produto adicionado ao carrinho!');

        $this->assertEquals([], session('cart'));
    }
}
