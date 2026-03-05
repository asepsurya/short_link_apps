<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\URL;

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
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }

        // Dynamically inject Google OAuth settings from Admin Settings if available
        $googleClientId = \Illuminate\Support\Facades\Cache::get('platform.google_client_id');
        $googleClientSecret = \Illuminate\Support\Facades\Cache::get('platform.google_client_secret');

        if (!empty($googleClientId) && !empty($googleClientSecret)) {
            config([
                'services.google.client_id' => $googleClientId,
                'services.google.client_secret' => $googleClientSecret,
            ]);
        }
    }
}

