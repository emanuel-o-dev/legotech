<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_lists_products()
    {
        $category = Category::factory()->create();
        $products = Product::factory()->count(3)->create([
            'category_id' => $category->id
        ]);

        $response = $this->get('/products');

        $response->assertStatus(200);
        $response->assertSee($products[0]->name);
        $response->assertSee($products[1]->name);
        $response->assertSee($products[2]->name);
    }

    /** @test */
    public function it_filters_products_by_category()
    {
        $cat1 = Category::factory()->create();
        $cat2 = Category::factory()->create();

        $p1 = Product::factory()->create(['category_id' => $cat1->id]);
        $p2 = Product::factory()->create(['category_id' => $cat2->id]);

        $response = $this->get('/products?category=' . $cat1->id);

        $response->assertStatus(200);
        $response->assertSee($p1->name);
        $response->assertDontSee($p2->name);
    }

    /** @test */
    public function it_shows_a_single_product()
    {
        $product = Product::factory()->create();

        $response = $this->get('/products/' . $product->id);

        $response->assertStatus(200);
        $response->assertSee($product->name);
    }
}
