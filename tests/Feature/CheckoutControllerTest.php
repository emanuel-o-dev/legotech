<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Event\Facade;
use Tests\TestCase;

class CheckoutControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $user = User::factory()->create();
        $this->actingAs($user);
    }

    /** @test */
    public function it_redirects_if_cart_is_empty()
    {
        $response = $this->get('/checkout');

        $response->assertRedirect('/cart');
        $response->assertSessionHas('error', 'Seu carrinho está vazio.');
    }

    /** @test */
    public function it_shows_checkout_page_with_items()
    {
        $this->withSession([
            'cart' => [
                1 => [
                    'id' => 1,
                    'name' => 'Produto Teste',
                    'price' => 10,
                    'quantity' => 2
                ]
            ]
        ]);

        $response = $this->get('/checkout');

        $response->assertStatus(200);
        $response->assertSee('Produto Teste');
    }
}
