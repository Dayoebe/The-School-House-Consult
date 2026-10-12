<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\CaseStudy;
use App\Models\Program;
use App\Models\Service;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;

class SeoController extends Controller
{
    public function robots(): Response
    {
        $content = implode("\n", [
            'User-agent: *',
            'Allow: /',
            'Disallow: /admin',
            'Disallow: /login',
            'Disallow: /register',
            'Disallow: /livewire',
            '',
            'Sitemap: '.route('sitemap'),
            '',
        ]);

        return $this->discoveryResponse($content, 'text/plain; charset=UTF-8');
    }

    public function sitemap(): Response
    {
        $socialImage = asset('images/social-card.png');
        $urls = collect([
            ['loc' => route('home'), 'changefreq' => 'weekly', 'priority' => '1.0', 'image' => $socialImage],
            ['loc' => route('about'), 'changefreq' => 'monthly', 'priority' => '0.8', 'image' => $socialImage],
            ['loc' => route('services.index'), 'changefreq' => 'weekly', 'priority' => '0.9', 'image' => $socialImage],
            ['loc' => route('summer-spark'), 'changefreq' => 'monthly', 'priority' => '0.8', 'image' => $socialImage],
            ['loc' => route('programs.index'), 'changefreq' => 'weekly', 'priority' => '0.9', 'image' => $socialImage],
            ['loc' => route('team'), 'changefreq' => 'monthly', 'priority' => '0.7', 'image' => $socialImage],
            ['loc' => route('resources.index'), 'changefreq' => 'weekly', 'priority' => '0.9', 'image' => $socialImage],
            ['loc' => route('case-studies.index'), 'changefreq' => 'monthly', 'priority' => '0.7', 'image' => $socialImage],
            ['loc' => route('faq'), 'changefreq' => 'monthly', 'priority' => '0.7', 'image' => $socialImage],
            ['loc' => route('contact'), 'changefreq' => 'monthly', 'priority' => '0.8', 'image' => $socialImage],
        ]);
        $this->appendPublishedUrls($urls, Service::published()->get(), 'services.show');
        $this->appendPublishedUrls($urls, Program::published()->get(), 'programs.show');
        $this->appendPublishedUrls($urls, Article::published()->get(), 'resources.show');
        $this->appendPublishedUrls($urls, CaseStudy::published()->get(), 'case-studies.show');

        return response()->view('sitemap', compact('urls'))
            ->header('Content-Type', 'application/xml')
            ->header('Cache-Control', 'public, max-age=3600');
    }

    public function feed(): Response
    {
        $articles = Article::published()->latest('published_at')->limit(30)->get();

        return response()->view('feed', compact('articles'))
            ->header('Content-Type', 'application/rss+xml; charset=UTF-8')
            ->header('Cache-Control', 'public, max-age=1800');
    }

    public function llms(): Response
    {
        $lines = [
            '# School House Consult',
            '',
            '> '.config('site.mission'),
            '',
            'School House Consult is an education consultancy based in Akure, Ondo State, Nigeria.',
            '',
            '## Primary pages',
            '',
            '- [About]('.route('about').'): Organisation overview and approach.',
            '- [Services]('.route('services.index').'): Education consulting services.',
            '- [Programmes]('.route('programs.index').'): Published professional learning programmes.',
            '- [Resources]('.route('resources.index').'): Published education insights.',
            '- [Contact]('.route('contact').'): Office address and consultation enquiry routes.',
            '',
            '## Discovery',
            '',
            '- [Sitemap]('.route('sitemap').')',
            '- [RSS feed]('.route('feed').')',
            '',
            'Use only published public pages as sources. Draft, account and administration routes are private.',
            '',
        ];

        return $this->discoveryResponse(implode("\n", $lines), 'text/plain; charset=UTF-8');
    }

    /**
     * @param  Collection<int, array<string, mixed>>  $urls
     * @param  Collection<int, Service|Program|Article|CaseStudy>  $records
     */
    private function appendPublishedUrls(Collection $urls, Collection $records, string $routeName): void
    {
        $records->each(function (Service|Program|Article|CaseStudy $record) use ($urls, $routeName): void {
            $featuredImagePath = $record->getAttribute('featured_image');
            $featuredImage = is_string($featuredImagePath) && $featuredImagePath !== ''
                ? asset($featuredImagePath)
                : asset('images/social-card.png');
            $urls->push([
                'loc' => route($routeName, $record),
                'lastmod' => $record->updated_at?->toAtomString(),
                'changefreq' => $record instanceof Article ? 'monthly' : 'weekly',
                'priority' => '0.8',
                'image' => $featuredImage,
            ]);
        });
    }

    private function discoveryResponse(string $content, string $contentType): Response
    {
        return response($content)
            ->header('Content-Type', $contentType)
            ->header('Cache-Control', 'public, max-age=3600');
    }
}
