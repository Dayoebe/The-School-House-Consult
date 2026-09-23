<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\AdminUserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminDashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_guests_are_redirected_to_admin_login(): void
    {
        $this->get('/admin')->assertRedirect(route('admin.login'));
    }

    public function test_super_admin_can_log_in_and_view_configured_dashboard_menu(): void
    {
        $this->seed(AdminUserSeeder::class);

        $this->post(route('admin.login.store'), [
            'email' => 'super@admin.com',
            'password' => '9638',
        ])->assertRedirect(route('admin.dashboard'));

        $this->get(route('admin.dashboard'))
            ->assertOk()
            ->assertSee('Services')
            ->assertSee('Consultation requests')
            ->assertSee('Good morning, Super Admin.');
    }

    public function test_non_admin_users_cannot_view_the_dashboard(): void
    {
        $user = User::factory()->create(['email' => 'editor@example.com']);

        $this->actingAs($user)->get(route('admin.dashboard'))->assertForbidden();
    }
}
