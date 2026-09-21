<?php

use App\Http\Controllers\SeoController;
use App\Livewire\SitePage;
use Illuminate\Support\Facades\Route;

Route::get('/', SitePage::class)->name('home');
Route::get('/about', SitePage::class)->name('about');
Route::get('/services', SitePage::class)->name('services.index');
Route::get('/services/{service:slug}', SitePage::class)->name('services.show');
Route::get('/programs', SitePage::class)->name('programs.index');
Route::get('/programs/{program:slug}', SitePage::class)->name('programs.show');
Route::get('/team', SitePage::class)->name('team');
Route::get('/resources', SitePage::class)->name('resources.index');
Route::get('/resources/{article:slug}', SitePage::class)->name('resources.show');
Route::get('/case-studies', SitePage::class)->name('case-studies.index');
Route::get('/case-studies/{caseStudy:slug}', SitePage::class)->name('case-studies.show');
Route::get('/faq', SitePage::class)->name('faq');
Route::get('/contact', SitePage::class)->name('contact');
Route::get('/sitemap.xml', [SeoController::class, 'sitemap'])->name('sitemap');

Route::get('/robots.txt', [SeoController::class, 'robots'])->name('robots');
