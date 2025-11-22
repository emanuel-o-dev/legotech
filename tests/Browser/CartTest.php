<?php

namespace Tests\Browser;

use App\Models\User;
use App\Models\Product;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CartTest extends DuskTestCase
{   

    public function test_user_can_add_item_to_cart()
    {
        $user = User::factory()->create();

        $product = Product::factory()->create();

        $this->browse(function (Browser $browser) use ($user, $product) {

            $browser->loginAs($user)
                ->visit('http://web/products')

                // Clicar no card → vai para /products/{id}
                ->clickLink($product->name)
                ->press("@add-to-cart-{$product->id}")
                ->visit('http://web/')
                ->assertSee($product->name);        
        });
    }

    public function test_user_can_increase_and_decrease_quantity()
    {
        $user = User::factory()->create();

        $product = Product::factory()->create();

        $this->browse(function (Browser $browser) use ($user, $product) {

            $browser->loginAs($user)
                ->visit('http://web/products')
                ->clickLink($product->name)
                ->press("Adicionar ao carrinho")
                ->visit('http://web/cart')

                ->assertSee('Qtd: 1')

                // Aumentar
                ->press("@increase")
                ->pause(300)
                ->assertSee('Qtd: 2')

                // Diminuir
                ->press("@decrease")
                ->pause(300)
                ->assertSee('Qtd: 1');
        });
    }

    public function test_user_can_remove_item_from_cart()
    {
        $user = User::factory()->create();

        $product = Product::factory()->create();

        $this->browse(function (Browser $browser) use ($user, $product) {

            $browser->loginAs($user)
                ->visit('http://web/products')
                ->clickLink($product->name)
                ->press("Adicionar ao carrinho")
                ->visit('http://web/cart')
                ->assertSee($product->name)

                // Remover
                ->press("X")
                ->pause(500)

                ->assertDontSee($product->name);
        });
    }
}
