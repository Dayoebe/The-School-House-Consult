<?php

namespace App\Providers;

use App\Models\SiteSetting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Throwable;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        try {
            if (! Schema::hasTable('site_settings')) {
                return;
            }

            $settings = SiteSetting::query()->first();

            if ($settings === null) {
                return;
            }

            foreach (['name', 'tagline', 'mission', 'email', 'phones', 'whatsapp', 'address', 'map_query'] as $key) {
                config()->set("site.{$key}", $settings->{$key});
            }
        } catch (Throwable) {
            // Keep the verified configuration defaults available when the database is offline.
        }
    }
}
