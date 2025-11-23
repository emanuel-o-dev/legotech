<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserOrdersTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_access_orders()
    {
        $this->get('/me/orders')
            ->assertRedirect('/login');
    }

    public function test_user_can_see_their_orders()
    {
        $user = User::factory()->create();
        $order = Order::factory()->create(['user_id' => $user->id]);

        $this->actingAs($user)
            ->get('/me/orders')
            ->assertStatus(200)
            ->assertSee((string)$order->id);
    }

    public function test_user_cannot_view_orders_of_other_users()
    {
        $u1 = User::factory()->create();
        $u2 = User::factory()->create();

        $order = Order::factory()->create(['user_id' => $u2->id]);

        $this->actingAs($u1)
            ->get("/me/orders/{$order->id}")
            ->assertStatus(403);
    }
}
