<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\CaseStudy;
use App\Models\Program;
use App\Models\Service;
use Illuminate\Http\Response;

class SeoController extends Controller
{
    public function robots(): Response
    {
        return response("User-agent: *\nAllow: /\nSitemap: ".route('sitemap')."\n")->header('Content-Type', 'text/plain');
    }

    public function sitemap(): Response
    {
        $urls = collect(['home', 'about', 'services.index', 'programs.index', 'team', 'resources.index', 'case-studies.index', 'faq', 'contact'])->map(fn ($name) => route($name));
        foreach ([Service::class => 'services.show', Program::class => 'programs.show', Article::class => 'resources.show', CaseStudy::class => 'case-studies.show'] as $model => $route) {
            $model::published()->select('slug')->each(function ($record) use ($urls, $route) {
                $urls->push(route($route, $record));
            });
        }

        return response()->view('sitemap', compact('urls'))->header('Content-Type', 'application/xml');
    }
}
