<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\CaseStudy;
use App\Models\ConsultationRequest;
use App\Models\ContactMessage;
use App\Models\Faq;
use App\Models\Program;
use App\Models\Service;
use App\Models\TeamMember;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class AdminDashboardController extends Controller
{
    public function __invoke(Request $request): View
    {
        $section = $request->route('section');
        $consultationStatus = $request->string('status')->toString();

        if (! in_array($consultationStatus, ['', 'new', 'in-progress', 'resolved', 'archived'], true)) {
            $consultationStatus = '';
        }

        abort_unless($section === null || in_array($section, [
            'services', 'programs', 'team', 'resources', 'case-studies', 'faqs', 'consultations', 'messages', 'settings', 'users',
        ], true), 404);

        $newConsultations = ConsultationRequest::where('status', 'new')->count();
        $newMessages = ContactMessage::where('status', 'new')->count();
        $activeInbox = ConsultationRequest::whereIn('status', ['new', 'in-progress'])->count()
            + ContactMessage::whereIn('status', ['new', 'in-progress'])->count();
        $publishedContent = Service::published()->count()
            + Program::published()->count()
            + TeamMember::where('is_active', true)->count()
            + Article::published()->count()
            + CaseStudy::published()->count()
            + Faq::where('is_active', true)->count();

        $contentInventory = collect([
            ['label' => 'Services', 'key' => 'services', 'total' => Service::count(), 'live' => Service::published()->count(), 'icon' => 'grid', 'tone' => 'blue'],
            ['label' => 'Programs', 'key' => 'programs', 'total' => Program::count(), 'live' => Program::published()->count(), 'icon' => 'book', 'tone' => 'violet'],
            ['label' => 'Team members', 'key' => 'team', 'total' => TeamMember::count(), 'live' => TeamMember::where('is_active', true)->count(), 'icon' => 'people', 'tone' => 'teal'],
            ['label' => 'Resources', 'key' => 'resources', 'total' => Article::count(), 'live' => Article::published()->count(), 'icon' => 'document', 'tone' => 'orange'],
            ['label' => 'Case studies', 'key' => 'case-studies', 'total' => CaseStudy::count(), 'live' => CaseStudy::published()->count(), 'icon' => 'growth', 'tone' => 'rose'],
            ['label' => 'FAQs', 'key' => 'faqs', 'total' => Faq::count(), 'live' => Faq::where('is_active', true)->count(), 'icon' => 'chat', 'tone' => 'emerald'],
        ])->map(function (array $item): array {
            $item['draft'] = $item['total'] - $item['live'];
            $item['progress'] = $item['total'] > 0 ? (int) round(($item['live'] / $item['total']) * 100) : 0;

            return $item;
        });

        $recentInbox = $this->recentInboxActivity();
        $inboxStatusCounts = collect(['new', 'in-progress', 'resolved', 'archived'])->mapWithKeys(fn (string $status): array => [
            $status => ConsultationRequest::where('status', $status)->count() + ContactMessage::where('status', $status)->count(),
        ]);

        return view('admin.dashboard', [
            'section' => $section,
            'stats' => [
                ['label' => 'Active services', 'value' => Service::published()->count(), 'icon' => 'grid', 'tone' => 'teal'],
                ['label' => 'Published resources', 'value' => Article::published()->count(), 'icon' => 'document', 'tone' => 'coral'],
                ['label' => 'New consultations', 'value' => $newConsultations, 'icon' => 'compass', 'tone' => 'gold'],
                ['label' => 'New messages', 'value' => $newMessages, 'icon' => 'chat', 'tone' => 'blue'],
            ],
            'contentCounts' => [
                'programs' => Program::count(),
                'team' => TeamMember::count(),
                'case-studies' => CaseStudy::count(),
                'faqs' => Faq::count(),
            ],
            'recentConsultations' => ConsultationRequest::query()->latest()->limit(5)->get(),
            'recentInbox' => $recentInbox,
            'contentInventory' => $contentInventory,
            'dashboardSummary' => [
                'new' => $newConsultations + $newMessages,
                'active' => $activeInbox,
                'published' => $publishedContent,
                'registered' => User::count(),
            ],
            'inboxStatusCounts' => $inboxStatusCounts,
            'consultations' => ConsultationRequest::query()->with('service')->when($consultationStatus !== '', fn ($query) => $query->where('status', $consultationStatus))->latest()->get(),
            'consultationStatus' => $consultationStatus,
            'servicesForAdmin' => $section === 'services' ? Service::query()->orderBy('category')->orderBy('sort_order')->orderBy('title')->get() : collect(),
            'programsForAdmin' => $section === 'programs' ? Program::query()->with('images')->latest()->get() : collect(),
            'messages' => ContactMessage::query()->latest()->get(),
            'users' => User::query()->latest()->get(),
        ]);
    }

    private function recentInboxActivity(): Collection
    {
        $consultations = ConsultationRequest::query()->latest()->limit(6)->get()->map(fn (ConsultationRequest $item): array => [
            'type' => 'Consultation',
            'title' => $item->full_name,
            'context' => $item->organisation ?: $item->organisation_type,
            'status' => $item->status,
            'created_at' => $item->created_at,
            'route' => route('admin.section', ['section' => 'consultations']),
            'icon' => 'compass',
        ]);
        $messages = ContactMessage::query()->latest()->limit(6)->get()->map(fn (ContactMessage $item): array => [
            'type' => 'Message',
            'title' => $item->full_name,
            'context' => $item->subject,
            'status' => $item->status,
            'created_at' => $item->created_at,
            'route' => route('admin.section', ['section' => 'messages']),
            'icon' => 'chat',
        ]);

        return $consultations->concat($messages)->sortByDesc('created_at')->take(6)->values();
    }
}
