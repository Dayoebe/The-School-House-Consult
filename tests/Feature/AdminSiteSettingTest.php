<?php

namespace Tests\Feature;

use App\Models\SiteSetting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminSiteSettingTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_view_and_update_public_site_settings(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $this->actingAs($admin)
            ->get(route('admin.section', ['section' => 'settings']))
            ->assertOk()
            ->assertSee('Manage your site identity.')
            ->assertSee(config('site.email'));

        $this->actingAs($admin)
            ->patch(route('admin.settings.update'), [
                'name' => 'Updated Education Consult',
                'tagline' => 'Education shaped with purpose.',
                'mission' => 'Supporting institutions through thoughtful educational strategy.',
                'email' => 'hello@example.com',
                'phone_displays' => ['0700-111-2233', '0800-444-5566'],
                'phone_values' => ['+2347001112233', '+2348004445566'],
                'whatsapp' => 'https://wa.me/2347001112233',
                'address' => '10 Education Road, Akure.',
                'map_query' => '10 Education Road, Akure, Nigeria',
            ])
            ->assertRedirect()
            ->assertSessionHas('status');

        $settings = SiteSetting::query()->firstOrFail();

        $this->assertSame('Updated Education Consult', $settings->name);
        $this->assertSame(['0700-111-2233' => '+2347001112233', '0800-444-5566' => '+2348004445566'], $settings->phones);
        $this->get(route('contact'))
            ->assertOk()
            ->assertSee('hello@example.com')
            ->assertSee('10 Education Road, Akure.')
            ->assertSee('0700-111-2233');
    }

    public function test_members_cannot_update_site_settings(): void
    {
        $member = User::factory()->create(['role' => 'member']);

        $this->actingAs($member)
            ->patch(route('admin.settings.update'), [])
            ->assertForbidden();

        $this->assertDatabaseEmpty('site_settings');
    }

    public function test_site_settings_require_valid_contact_details(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $this->actingAs($admin)
            ->from(route('admin.section', ['section' => 'settings']))
            ->patch(route('admin.settings.update'), [
                'name' => 'School House',
                'email' => 'not-an-email',
                'phone_displays' => ['0700 000 0000'],
                'phone_values' => ['07000000000'],
                'whatsapp' => 'not-a-url',
                'address' => '',
                'map_query' => '',
            ])
            ->assertRedirect(route('admin.section', ['section' => 'settings']))
            ->assertSessionHasErrors(['email', 'phone_values.0', 'whatsapp', 'address', 'map_query']);

        $this->assertDatabaseEmpty('site_settings');
    }
}
