<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\ConsultationRequest;
use App\Models\ContactMessage;
use Database\Seeders\AdminUserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminDashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_guests_are_redirected_to_shared_login(): void
    {
        $this->get('/admin')->assertRedirect(route('login'));
    }

    public function test_super_admin_can_log_in_and_view_configured_dashboard_menu(): void
    {
        $this->seed(AdminUserSeeder::class);

        $this->post(route('login.store'), [
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

    public function test_people_can_register_as_members(): void
    {
        $this->post(route('register.store'), [
            'name' => 'A New Member',
            'email' => 'member@example.com',
            'password' => 'password-123',
            'password_confirmation' => 'password-123',
        ])->assertRedirect(route('home'));

        $this->assertDatabaseHas('users', [
            'email' => 'member@example.com',
            'name' => 'A New Member',
            'role' => 'member',
        ]);
    }

    public function test_member_login_returns_to_the_page_requested_before_login(): void
    {
        $member = User::factory()->create(['role' => 'member']);

        $this->get(route('login', ['redirect' => route('about')]))->assertOk();

        $this->post(route('login.store'), [
            'email' => $member->email,
            'password' => 'password',
        ])->assertRedirect(route('about'));
    }

    public function test_admin_can_promote_a_member(): void
    {
        $this->seed(AdminUserSeeder::class);
        $member = User::factory()->create(['role' => 'member']);

        $this->actingAs(User::where('email', 'super@admin.com')->first())
            ->patch(route('admin.users.role', $member), ['role' => 'admin'])
            ->assertRedirect();

        $this->assertDatabaseHas('users', ['id' => $member->id, 'role' => 'admin']);
    }

    public function test_admin_can_view_submitted_contact_forms_and_update_status(): void
    {
        $this->seed(AdminUserSeeder::class);
        $admin = User::where('email', 'super@admin.com')->firstOrFail();
        $consultation = ConsultationRequest::create([
            'full_name' => 'Consultation Visitor',
            'organisation' => 'Example School',
            'email' => 'consultation@example.com',
            'phone' => '07061234567',
            'organisation_type' => 'School / Institution',
            'message' => 'We would like to discuss curriculum support for our school.',
            'preferred_contact_method' => 'Email',
        ]);
        $message = ContactMessage::create([
            'full_name' => 'Message Visitor',
            'email' => 'message@example.com',
            'subject' => 'A general enquiry',
            'message' => 'Please share more information about your services.',
        ]);

        $this->actingAs($admin)->get(route('admin.section', ['section' => 'consultations']))
            ->assertOk()->assertSee('Consultation Visitor')->assertSee('Example School');
        $this->actingAs($admin)->get(route('admin.section', ['section' => 'messages']))
            ->assertOk()->assertSee('A general enquiry')->assertSee('Message Visitor');
        $this->actingAs($admin)->patch(route('admin.consultations.status', $consultation), ['status' => 'resolved'])->assertRedirect();
        $this->actingAs($admin)->patch(route('admin.messages.status', $message), ['status' => 'in-progress'])->assertRedirect();

        $this->assertDatabaseHas('consultation_requests', ['id' => $consultation->id, 'status' => 'resolved']);
        $this->assertDatabaseHas('contact_messages', ['id' => $message->id, 'status' => 'in-progress']);
    }
}
