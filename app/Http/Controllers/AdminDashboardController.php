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
use Illuminate\View\View;

class AdminDashboardController extends Controller
{
    public function __invoke(Request $request): View
    {
        $section = $request->route('section');

        abort_unless($section === null || in_array($section, [
            'services', 'programs', 'team', 'resources', 'case-studies', 'faqs', 'consultations', 'messages', 'settings', 'users',
        ], true), 404);

        return view('admin.dashboard', [
            'section' => $section,
            'stats' => [
                ['label' => 'Active services', 'value' => Service::published()->count(), 'icon' => 'grid', 'tone' => 'teal'],
                ['label' => 'Published resources', 'value' => Article::published()->count(), 'icon' => 'document', 'tone' => 'coral'],
                ['label' => 'Consultation requests', 'value' => ConsultationRequest::where('status', 'new')->count(), 'icon' => 'compass', 'tone' => 'gold'],
                ['label' => 'Contact messages', 'value' => ContactMessage::where('status', 'new')->count(), 'icon' => 'chat', 'tone' => 'blue'],
            ],
            'contentCounts' => [
                'programs' => Program::count(),
                'team' => TeamMember::count(),
                'case-studies' => CaseStudy::count(),
                'faqs' => Faq::count(),
            ],
            'recentConsultations' => ConsultationRequest::query()->latest()->limit(5)->get(),
            'users' => User::query()->latest()->get(),
        ]);
    }
}
