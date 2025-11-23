<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ToggleRoleTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_toggle_own_role()
    {
        $user = User::factory()->create(['role' => 'USER']);

        $this->actingAs($user)
            ->post(route('toggle.role', $user))
            ->assertRedirect();

        $user->refresh();

        $this->assertEquals('ADMIN', $user->role);
    }

    public function test_guest_cannot_toggle_role()
    {
        $user = User::factory()->create();

        $this->post(route('toggle.role', $user))
            ->assertRedirect('/login');
    }
}
