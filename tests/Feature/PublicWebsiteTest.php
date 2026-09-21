<?php

namespace Tests\Feature;

use App\Livewire\ConsultationForm;
use App\Livewire\ContactForm;
use App\Models\Article;
use App\Models\CaseStudy;
use App\Models\Category;
use App\Models\ConsultationRequest;
use App\Models\Program;
use App\Models\Service;
use App\Models\TeamMember;
use Database\Seeders\SiteContentSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\RateLimiter;
use Livewire\Livewire;
use Tests\TestCase;

class PublicWebsiteTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(SiteContentSeeder::class);
    }

    public function test_all_public_pages_have_metadata_and_one_main_heading(): void
    {
        foreach (['/', '/about', '/services', '/programs', '/team', '/resources', '/case-studies', '/faq', '/contact'] as $url) {
            $response = $this->get($url)->assertOk()->assertSee('name="description"', false)->assertSee('rel="canonical"', false)->assertSee('property="og:image"', false);
            $this->assertSame(1, substr_count($response->getContent(), '<h1'), $url);
        }
        $this->get('/')->assertSee('Shaping the')->assertSee('Adedamola Ogidan');
    }

    public function test_all_thirteen_services_resolve_and_inactive_services_are_private(): void
    {
        $this->assertSame(13, Service::count());
        foreach (Service::all() as $service) {
            $this->get(route('services.show', $service))->assertOk()->assertSee($service->title);
        }
        $service = Service::first();
        $service->update(['is_active' => false]);
        $this->get(route('services.show', $service))->assertNotFound();
        $this->get('/sitemap.xml')->assertDontSee(route('services.show', $service));
    }

    public function test_published_content_is_visible_and_drafts_and_scheduled_content_are_not(): void
    {
        foreach ([Article::class => 'resources', CaseStudy::class => 'case-studies'] as $model => $prefix) {
            $draft = $model::factory()->create();
            $future = $model::factory()->create(['status' => 'published', 'published_at' => now()->addDay()]);
            $undated = $model::factory()->create(['status' => 'published']);
            $published = $model::factory()->create(['status' => 'published', 'published_at' => now()->subDay()]);
            $this->get('/'.$prefix)->assertSee($published->title)->assertDontSee($draft->title)->assertDontSee($future->title)->assertDontSee($undated->title);
            foreach ([$draft, $future, $undated] as $hidden) {
                $this->get('/'.$prefix.'/'.$hidden->slug)->assertNotFound();
            }
            $this->get('/'.$prefix.'/'.$published->slug)->assertOk();
            $this->get('/sitemap.xml')->assertSee($published->slug)->assertDontSee($draft->slug)->assertDontSee($future->slug);
        }
        $draft = Program::factory()->create();
        $program = Program::factory()->create(['status' => 'published']);
        $this->get('/programs')->assertSee($program->title)->assertDontSee($draft->title);
        $this->get(route('programs.show', $program))->assertOk();
        $this->get(route('programs.show', $draft))->assertNotFound();
    }

    public function test_article_category_filtering_pagination_relationship_and_safe_markdown(): void
    {
        $category = Category::create(['name' => 'Leadership', 'slug' => 'leadership']);
        Article::factory()->count(10)->create(['category_id' => $category->id, 'status' => 'published', 'published_at' => now()->subDay()]);
        $other = Article::factory()->create(['title' => 'Unrelated category article', 'status' => 'published', 'published_at' => now()->subDay()]);
        $this->assertSame(10, $category->articles()->count());
        $this->get('/resources?category=leadership')->assertOk()->assertSee('Leadership')->assertDontSee($other->title)->assertSee('Next');
        $article = $category->articles()->first();
        $article->update(['body' => '## Safe heading'."\n\n".'<script>alert("xss")</script>'."\n\n".'[unsafe](javascript:alert(1))']);
        $this->get(route('resources.show', $article))->assertOk()->assertSee('Safe heading')->assertDontSee('<script>alert', false)->assertDontSee('href="javascript:', false);
    }

    public function test_consultation_is_validated_saved_and_not_duplicated(): void
    {
        Livewire::test(ConsultationForm::class)->call('submit')->assertHasErrors(['full_name', 'email', 'phone', 'organisation_type', 'message']);
        $service = Service::first();
        $form = Livewire::test(ConsultationForm::class)->set('full_name', 'A Test Enquirer')->set('organisation', 'Private test organisation')->set('email', 'private@example.com')->set('phone', '07061234567')->set('organisation_type', 'School / Institution')->set('service_id', (string) $service->id)->set('message', 'A private request about curriculum support.')->set('preferred_contact_method', 'Email')->call('submit')->assertHasNoErrors()->assertSet('submitted', true)->assertSee('Your consultation request has been received.');
        $this->assertDatabaseHas('consultation_requests', ['email' => 'private@example.com', 'service_id' => $service->id]);
        $this->assertTrue(ConsultationRequest::first()->service->is($service));
        $form->call('submit');
        $this->assertDatabaseCount('consultation_requests', 1);
        foreach (['/', '/contact', '/resources', '/team'] as $url) {
            $this->get($url)->assertDontSee('private@example.com')->assertDontSee('Private test organisation');
        }
        $this->get('/consultation-requests')->assertNotFound();
    }

    public function test_consultation_rejects_invalid_service_and_contact_method(): void
    {
        $service = Service::first();
        $service->update(['is_active' => false]);
        Livewire::test(ConsultationForm::class)->set('service_id', (string) $service->id)->set('preferred_contact_method', 'Injected')->call('submit')->assertHasErrors(['service_id', 'preferred_contact_method']);
        $this->assertDatabaseCount('consultation_requests', 0);
    }

    public function test_contact_message_validation_storage_and_spam_protection(): void
    {
        Livewire::test(ContactForm::class)->set('email', 'invalid')->call('submit')->assertHasErrors(['full_name', 'email', 'subject', 'message']);
        Livewire::test(ContactForm::class)->set('website', 'spam')->call('submit')->assertHasErrors(['submission']);
        $this->assertDatabaseCount('contact_messages', 0);
        $form = Livewire::test(ContactForm::class)->set('full_name', 'Contact Tester')->set('email', 'contact@example.com')->set('subject', 'General enquiry')->set('message', 'Please tell me about your services.')->call('submit')->assertHasNoErrors()->assertSet('submitted', true);
        $form->call('submit');
        $this->assertDatabaseCount('contact_messages', 1);
        $this->assertDatabaseHas('contact_messages', ['email' => 'contact@example.com']);
        $this->get('/contact-messages')->assertNotFound();
    }

    public function test_submission_rate_limit_prevents_writes(): void
    {
        $key = 'public-enquiries:'.hash('sha256', '127.0.0.1');
        for ($i = 0; $i < 5; $i++) {
            RateLimiter::hit($key, 600);
        }
        Livewire::test(ContactForm::class)->set('full_name', 'Contact Tester')->set('email', 'contact@example.com')->set('subject', 'General enquiry')->set('message', 'Please tell me about your services.')->call('submit')->assertHasErrors('submission');
        $this->assertDatabaseCount('contact_messages', 0);
    }

    public function test_team_contact_details_are_private_by_default_and_seed_is_repeatable(): void
    {
        $member = TeamMember::first();
        $member->update(['email' => 'private-team@example.com', 'phone' => '123456789', 'social_links' => ['Profile' => 'javascript:alert(1)']]);
        $this->get('/team')->assertDontSee('private-team@example.com')->assertDontSee('123456789');
        $member->update(['publish_contact' => true]);
        $this->get('/team')->assertSee('private-team@example.com')->assertDontSee('href="javascript:', false);
        $this->seed(SiteContentSeeder::class);
        $this->assertDatabaseCount('services', 13);
        $this->assertDatabaseCount('team_members', 1);
        $this->assertDatabaseCount('faqs', 4);
    }

    public function test_branded_not_found_and_sitemap_work(): void
    {
        $this->get('/robots.txt')->assertOk()->assertSee(route('sitemap'));
        $this->get('/does-not-exist')->assertNotFound()->assertSee('Page Not Found')->assertSee('Return Home')->assertSee('noindex, follow');
        $this->get('/sitemap.xml')->assertOk()->assertHeader('Content-Type', 'application/xml')->assertSee(route('contact'))->assertSee(route('services.show', Service::first()));
    }
}
