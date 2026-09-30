<?php

namespace Tests\Feature;

use App\Models\ConsultationRequest;
use App\Models\ContactMessage;
use App\Models\Program;
use App\Models\Service;
use App\Models\User;
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

    public function test_admin_can_filter_and_delete_consultation_requests(): void
    {
        $this->seed(AdminUserSeeder::class);
        $admin = User::where('email', 'super@admin.com')->firstOrFail();
        $newRequest = ConsultationRequest::create([
            'full_name' => 'New Request', 'email' => 'new@example.com', 'phone' => '07061234567',
            'organisation_type' => 'Other', 'message' => 'This is a new consultation request for testing.',
            'preferred_contact_method' => 'Email', 'status' => 'new',
        ]);
        $archivedRequest = ConsultationRequest::create([
            'full_name' => 'Archived Request', 'email' => 'archived@example.com', 'phone' => '07061234568',
            'organisation_type' => 'Other', 'message' => 'This is an archived consultation request for testing.',
            'preferred_contact_method' => 'Email', 'status' => 'archived',
        ]);

        $this->actingAs($admin)->get(route('admin.section', ['section' => 'consultations', 'status' => 'new']))
            ->assertOk()->assertSee('New Request')->assertDontSee('Archived Request');
        $this->actingAs($admin)->delete(route('admin.consultations.destroy', $archivedRequest))->assertRedirect();

        $this->assertDatabaseHas('consultation_requests', ['id' => $newRequest->id]);
        $this->assertDatabaseMissing('consultation_requests', ['id' => $archivedRequest->id]);
    }

    public function test_admin_service_edits_drive_the_public_expertise_pages(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $service = Service::create([
            'title' => 'Original Service',
            'slug' => 'original-service',
            'icon' => 'book',
            'category' => 'Academic & Curriculum',
            'description' => 'Original public description.',
            'introduction' => 'Original service introduction.',
            'activities' => ['Original activity'],
            'audience' => 'School leaders',
            'sort_order' => 2,
            'is_active' => true,
        ]);

        $this->actingAs($admin)->patch(route('admin.services.update', ['serviceId' => $service->getKey()]), [
            'title' => 'Updated Curriculum Service',
            'slug' => 'updated-curriculum-service',
            'icon' => 'story',
            'category' => 'Academic & Curriculum',
            'description' => 'Updated public description from the administrator.',
            'introduction' => 'Updated service introduction from the administrator.',
            'activities' => "Curriculum review\nImplementation planning",
            'audience' => 'Curriculum leaders and school teams',
            'sort_order' => 1,
            'is_active' => '1',
        ])->assertRedirect();

        $service->refresh();
        $this->assertSame(['Curriculum review', 'Implementation planning'], $service->activities);
        $this->get(route('services.index'))->assertOk()->assertSee('Updated Curriculum Service')->assertSee('Updated public description from the administrator.');
        $this->get(route('services.show', $service))->assertOk()->assertSee('Updated service introduction from the administrator.');
    }

    public function test_admin_program_edits_drive_the_public_programme_pages(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $program = Program::create([
            'title' => 'Original Programme',
            'slug' => 'original-programme',
            'description' => 'Original programme description.',
            'target_audience' => 'School leaders',
            'duration' => 'Two days',
            'status' => 'draft',
        ]);

        $this->actingAs($admin)->patch(route('admin.programs.update', ['programId' => $program->getKey()]), [
            'title' => 'Strategic Leadership Programme',
            'slug' => 'strategic-leadership-programme',
            'description' => 'A confirmed programme description published from the administrator.',
            'target_audience' => 'School owners and leadership teams',
            'duration' => 'Three days',
            'status' => 'published',
        ])->assertRedirect();

        $program->refresh();
        $this->assertSame('published', $program->status);
        $this->get(route('programs.index'))->assertOk()->assertSee('Strategic Leadership Programme');
        $this->get(route('programs.show', $program))->assertOk()->assertSee('A confirmed programme description published from the administrator.');
    }
}
