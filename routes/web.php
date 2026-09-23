<?php

use App\Http\Controllers\SeoController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AuthController;
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

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.store');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.store');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::prefix('admin')->name('admin.')->group(function (): void {
	Route::get('/login', [AdminAuthController::class, 'create'])->name('login');
	Route::post('/login', [AdminAuthController::class, 'store'])->name('login.store');
	Route::middleware(['auth', 'admin'])->group(function (): void {
		Route::get('/', AdminDashboardController::class)->name('dashboard');
		Route::get('/{section}', AdminDashboardController::class)->name('section');
		Route::patch('/users/{user}/role', [AdminUserController::class, 'updateRole'])->name('users.role');
		Route::post('/logout', [AdminAuthController::class, 'destroy'])->name('logout');
	});
});
