<?php

namespace Tests\Browser;

use App\Models\User;
use App\Models\Product;
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
                ->visitRoute('products.index')
                ->waitForText($product->name)

                ->clickLink($product->name)
                ->waitFor('@add-to-cart')

                ->press('@add-to-cart')
                ->pause(300)

                ->visitRoute('cart.index')
                ->waitForText('Qtd:')

                ->assertSee($product->name)
                ->assertSee('Qtd: 1');
        });
    }

    public function test_user_can_increase_and_decrease_quantity()
    {
        $user = User::factory()->create();
        $product = Product::factory()->create();

        $this->browse(function (Browser $browser) use ($user, $product) {

            $browser->loginAs($user)

                // adicionar ao carrinho
                ->visitRoute('products.index')
                ->waitForText($product->name)
                ->clickLink($product->name)
                ->waitFor('@add-to-cart')
                ->press('@add-to-cart')
                ->pause(300)

                // ir ao carrinho
                ->visitRoute('cart.index')
                ->waitForText('Qtd: 1')

                // aumentar quantidade
                ->press('@increase-' . $product->id)
                ->pause(500)
                ->assertSee('Qtd: 2')

                // diminuir quantidade
                ->press('@decrease-' . $product->id)
                ->pause(500)
                ->assertSee('Qtd: 1');
        });
    }

    public function test_user_can_remove_item_from_cart()
    {
        $user = User::factory()->create();
        $product = Product::factory()->create();

        $this->browse(function (Browser $browser) use ($user, $product) {

            $browser->loginAs($user)

                // adicionar ao carrinho
                ->visitRoute('products.index')
                ->waitForText($product->name)
                ->clickLink($product->name)
                ->waitFor('@add-to-cart')
                ->press('@add-to-cart')
                ->pause(300)

                // ir ao carrinho
                ->visitRoute('cart.index')
                ->waitForText('Qtd: 1')

                // remover item
                ->press('@remove-' . $product->id)
                ->pause(500)
                // alert de remoção
                ->assertSee('Item removido.')

                ->assertDontSee($product->name);
        });
    }
}
