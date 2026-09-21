<?php

namespace App\Livewire;

use App\Models\Article;
use App\Models\CaseStudy;
use App\Models\Category;
use App\Models\Faq;
use App\Models\Program;
use App\Models\Service;
use App\Models\TeamMember;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class SitePage extends Component
{
    use WithPagination;

    #[Locked]
    public string $page = 'home';

    #[Locked]
    public string $slug = '';

    #[Url]
    public string $category = '';

    public function mount(?Service $service = null, ?Program $program = null, ?Article $article = null, ?CaseStudy $caseStudy = null): void
    {
        $this->page = request()->route()->getName();
        foreach (['service', 'program', 'article', 'caseStudy'] as $parameter) {
            if ($record = request()->route($parameter)) {
                $this->slug = $record->slug;
            }
        }
    }

    public function updatedCategory(): void
    {
        $this->resetPage();
    }

    public function render(): View
    {
        $meta = [
            'home' => ['Education Consulting for Schools, Educators & Communities', 'Strategic educational solutions, curriculum development and professional learning. Partner with The School House Consult in Akure, Nigeria.'],
            'about' => ['About Us', 'Learn about our mission, collaborative approach and Principal Consultant at The School House Consult.'],
            'services.index' => ['Education Consulting Services', 'Explore 13 areas of expertise, from curriculum design and instructional coaching to leadership and school improvement planning.'],
            'programs.index' => ['Programs & Training', 'Explore professional learning areas for teachers and school leaders, and enquire about training needs.'],
            'team' => ['Our Team', 'Meet Adedamola Ogidan, Principal Consultant at The School House Consult.'],
            'resources.index' => ['Education Resources & Insights', 'Articles and perspectives on teaching, leadership and educational development from The School House Consult.'],
            'case-studies.index' => ['Case Studies', 'Project stories and educational consulting case studies from The School House Consult, as they become available.'],
            'faq' => ['Frequently Asked Questions', 'Find out what we do, who we work with and how to contact The School House Consult.'],
            'contact' => ['Contact & Request a Consultation', 'Discuss your educational challenge with The School House Consult. Contact our Akure office or submit a consultation request.'],
        ];
        $data = [];
        if (in_array($this->page, ['home', 'about', 'services.index', 'services.show'])) {
            $data['services'] = Service::published()->orderBy('sort_order')->get();
        }
        if (in_array($this->page, ['home', 'about', 'team'])) {
            $data['team'] = TeamMember::where('is_active', true)->orderBy('sort_order')->get();
        }
        if ($this->page === 'home') {
            $data['articles'] = Article::published()->with('category')->latest('published_at')->limit(3)->get();
            $data['caseStudies'] = CaseStudy::published()->latest('published_at')->limit(2)->get();
            $data['programs'] = Program::published()->latest()->limit(3)->get();
        }
        if ($this->page === 'programs.index') {
            $data['programs'] = Program::published()->latest()->paginate(9);
        }
        if ($this->page === 'resources.index') {
            $data['categories'] = Category::whereHas('articles', fn ($q) => $q->published())->orderBy('name')->get();
            $data['articles'] = Article::published()->with('category')->when($this->category !== '', fn ($q) => $q->whereHas('category', fn ($c) => $c->where('slug', $this->category)))->latest('published_at')->paginate(9);
        }
        if ($this->page === 'case-studies.index') {
            $data['caseStudies'] = CaseStudy::published()->latest('published_at')->paginate(9);
        }
        if ($this->page === 'faq') {
            $data['faqs'] = Faq::where('is_active', true)->orderBy('sort_order')->get();
        }
        $image = asset('images/social-card.png');
        $publishedArticle = null;
        if (str_ends_with($this->page, '.show')) {
            $model = match ($this->page) {
                'services.show' => Service::class, 'programs.show' => Program::class,
                'resources.show' => Article::class, 'case-studies.show' => CaseStudy::class,
            };
            $record = $model::published()->where('slug', $this->slug)->firstOrFail();
            $data['record'] = $record;
            $meta[$this->page] = [$record->seo_title ?: $record->title, $record->seo_description ?: ($record->excerpt ?: ($record->summary ?: $record->description))];
            if ($record->featured_image) {
                $image = asset($record->featured_image);
            }
            if ($record instanceof Article) {
                $publishedArticle = $record;
            }
        }
        [$title, $description] = $meta[$this->page];
        $canonical = route($this->page, $this->slug ? [$this->slug] : []);
        $query = array_filter(['category' => $this->page === 'resources.index' ? $this->category : '', 'page' => $this->getPage() > 1 ? $this->getPage() : null]);
        if ($query) {
            $canonical .= '?'.http_build_query($query);
        }

        return view('livewire.site-page', $data)->layout('layouts.app', compact('title', 'description', 'canonical', 'image', 'publishedArticle'));
    }
}
