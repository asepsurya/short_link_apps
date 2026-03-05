<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Link;
use App\Models\LinkClick;

class AdminController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalLinks = Link::count();
        $totalClicks = LinkClick::count();
        $totalApiRequests = (int) Cache::get('platform.total_api_requests', 0);

        $recentUsers = User::withCount('links')->latest()->take(5)->get();
        $guestLinks = Link::whereNull('user_id')->latest()->paginate(10, ['*'], 'guest_page');

        $latestRelease = $this->getLatestRelease();
        $currentVersion = config('app.version', '1.0.0');
        $hasUpdate = $latestRelease && version_compare($latestRelease['tag'], $currentVersion, '>');

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalLinks',
            'totalClicks',
            'totalApiRequests',
            'recentUsers',
            'guestLinks',
            'latestRelease',
            'currentVersion',
            'hasUpdate'
        ));
    }

    public function users()
    {
        $users = User::withCount('links')
            ->latest()
            ->paginate(15);

        return view('admin.users', compact('users'));
    }

    public function deleteUser(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->withErrors(['error' => 'Cannot delete yourself.']);
        }
        $user->delete();
        return back()->with('success', 'User deleted successfully.');
    }

    /**
     * Batch update all links to enable or disable the redirect page.
     */
    public function batchUpdateRedirect(Request $request)
    {
        $useRedirect = $request->boolean('use_redirect_page', true);
        Link::query()->update(['use_redirect_page' => $useRedirect]);

        $status = $useRedirect ? 'enabled' : 'disabled';
        return back()->with('success', "10-second redirect page has been {$status} for all links.");
    }

    /**
     * Update the platform-wide default for redirect page (stored in env config).
     * Note: this is a soft toggle — it affects new links created without a user override.
     */
    public function updateRedirectSetting(Request $request)
    {
        // Store in cache as a platform preference (real apps would use a settings table)
        Cache::forever('platform.use_redirect_page', $request->boolean('use_redirect_page', true));
        return back()->with('success', 'Platform redirect setting updated.');
    }

    /**
     * Update global API settings.
     */
    public function updateApiSettings(Request $request)
    {
        Cache::forever('platform.api_enabled', $request->boolean('api_enabled', true));
        Cache::forever('platform.api_rate_limit', $request->integer('api_rate_limit', 60));

        return back()->with('success', 'API settings successfully updated.');
    }

    /**
     * Show application settings page.
     */
    public function appSettings()
    {
        return view('admin.settings');
    }

    /**
     * Update application settings.
     */
    public function updateAppSettings(Request $request)
    {
        $validated = $request->validate([
            // General / SEO
            'app_name' => 'required|string|max:255',
            'footer_text' => 'nullable|string|max:255',
            'primary_color' => 'nullable|string|max:7', // Hex color
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string|max:255',
            'redirect_duration' => 'nullable|integer|min:0|max:60',
            'analytics_script' => 'nullable|string',
            'adsense_script' => 'nullable|string',
            'ads_top_banner' => 'nullable|string',
            'ads_mid_banner' => 'nullable|string',
            'ads_bottom_banner' => 'nullable|string',
            'ads_redirect_top' => 'nullable|string',
            'ads_redirect_bottom' => 'nullable|string',
            'app_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',

            // App Env Settings
            'app_env' => 'required|in:local,production',
            'app_debug' => 'required|boolean',
            'app_url' => 'required|url',

            // Database Settings
            'db_connection' => 'required|string',
            'db_host' => 'required|string',
            'db_port' => 'required|numeric',
            'db_database' => 'required|string',
            'db_username' => 'required|string',
            'db_password' => 'nullable|string',

            // Mail config
            'mail_mailer' => 'required|string',
            'mail_host' => 'required|string',
            'mail_port' => 'required|numeric',
            'mail_username' => 'nullable|string',
            'mail_password' => 'nullable|string',
            'mail_from_address' => 'required|email',
            'mail_from_name' => 'required|string',

            // Services
            'google_client_id' => 'nullable|string',
            'google_client_secret' => 'nullable|string',
            'hcaptcha_sitekey' => 'nullable|string',
            'hcaptcha_secret' => 'nullable|string',

            // Advanced Array
            'redis_host' => 'required|string',
            'redis_password' => 'nullable|string',
            'redis_port' => 'required|numeric',
            'aws_access_key_id' => 'nullable|string',
            'aws_secret_access_key' => 'nullable|string',
            'aws_default_region' => 'nullable|string',
            'aws_bucket' => 'nullable|string',
        ]);

        if ($request->hasFile('app_logo')) {
            // Delete old logo if exists
            if (Cache::has('platform.logo_path')) {
                Storage::disk('public')->delete(Cache::get('platform.logo_path'));
            }
            $path = $request->file('app_logo')->store('platform', 'public');
            Cache::forever('platform.logo_path', $path);
        } elseif ($request->boolean('reset_logo')) {
            // Reset to default
            if (Cache::has('platform.logo_path')) {
                Storage::disk('public')->delete(Cache::get('platform.logo_path'));
            }
            Cache::forget('platform.logo_path');
        }

        Cache::forever('platform.app_name', $validated['app_name']);
        Cache::forever('platform.footer_text', $validated['footer_text'] ?? '');
        Cache::forever('platform.primary_color', $validated['primary_color'] ?? '#7c3aed');
        Cache::forever('platform.meta_title', $validated['meta_title'] ?? '');
        Cache::forever('platform.meta_description', $validated['meta_description'] ?? '');
        Cache::forever('platform.meta_keywords', $validated['meta_keywords'] ?? '');
        Cache::forever('platform.redirect_duration', $validated['redirect_duration'] ?? 10);
        Cache::forever('platform.analytics_script', $validated['analytics_script'] ?? '');
        Cache::forever('platform.adsense_script', $validated['adsense_script'] ?? '');
        Cache::forever('platform.ads_top_banner', $validated['ads_top_banner'] ?? '');
        Cache::forever('platform.ads_mid_banner', $validated['ads_mid_banner'] ?? '');
        Cache::forever('platform.ads_bottom_banner', $validated['ads_bottom_banner'] ?? '');
        Cache::forever('platform.ads_redirect_top', $validated['ads_redirect_top'] ?? '');
        Cache::forever('platform.ads_redirect_bottom', $validated['ads_redirect_bottom'] ?? '');

        // Handle Guest Link Toggle
        Cache::forever('platform.enable_guest_links', $request->has('enable_guest_links') ? $request->boolean('enable_guest_links') : false);

        // Env Batch Updates
        $envUpdates = [
            'APP_NAME' => '"' . $validated['app_name'] . '"',
            'APP_ENV' => $validated['app_env'],
            'APP_DEBUG' => $validated['app_debug'] ? 'true' : 'false',
            'APP_URL' => '"' . rtrim($validated['app_url'], '/') . '"',

            'DB_CONNECTION' => $validated['db_connection'],
            'DB_HOST' => $validated['db_host'],
            'DB_PORT' => $validated['db_port'],
            'DB_DATABASE' => $validated['db_database'],
            'DB_USERNAME' => $validated['db_username'],
            'DB_PASSWORD' => $validated['db_password'] ? '"' . $validated['db_password'] . '"' : '',

            'MAIL_MAILER' => $validated['mail_mailer'],
            'MAIL_HOST' => $validated['mail_host'],
            'MAIL_PORT' => $validated['mail_port'],
            'MAIL_USERNAME' => $validated['mail_username'] ? '"' . $validated['mail_username'] . '"' : 'null',
            'MAIL_PASSWORD' => $validated['mail_password'] ? '"' . $validated['mail_password'] . '"' : 'null',
            'MAIL_FROM_ADDRESS' => '"' . $validated['mail_from_address'] . '"',
            'MAIL_FROM_NAME' => '"' . $validated['mail_from_name'] . '"',

            'REDIS_HOST' => $validated['redis_host'],
            'REDIS_PASSWORD' => $validated['redis_password'] ? '"' . $validated['redis_password'] . '"' : 'null',
            'REDIS_PORT' => $validated['redis_port'],

            'AWS_ACCESS_KEY_ID' => $validated['aws_access_key_id'] ?? '',
            'AWS_SECRET_ACCESS_KEY' => $validated['aws_secret_access_key'] ?? '',
            'AWS_DEFAULT_REGION' => $validated['aws_default_region'] ?? 'us-east-1',
            'AWS_BUCKET' => $validated['aws_bucket'] ?? '',

            'GOOGLE_CLIENT_ID' => $validated['google_client_id'] ?? '',
            'GOOGLE_CLIENT_SECRET' => $validated['google_client_secret'] ?? '',

            'HCAPTCHA_SITEKEY' => $validated['hcaptcha_sitekey'] ?? '',
            'HCAPTCHA_SECRET' => $validated['hcaptcha_secret'] ?? '',
        ];

        // Safely write to .env file
        $this->setEnvValue($envUpdates);

        return back()->with('success', 'Application settings updated successfully.');
    }

    /**
     * Get latest release from GitHub API.
     */
    private function getLatestRelease()
    {
        return Cache::remember('platform.github_release', 3600, function () {
            try {
                $client = new \GuzzleHttp\Client();
                $response = $client->get('https://api.github.com/repos/asepsurya/short_link_apps/releases/latest', [
                    'headers' => [
                        'User-Agent' => 'Laravel-App',
                        'Accept' => 'application/vnd.github.v3+json',
                    ],
                    'timeout' => 5,
                ]);

                if ($response->getStatusCode() === 200) {
                    $release = json_decode($response->getBody(), true);
                    return [
                        'tag' => $release['tag_name'],
                        'name' => $release['name'],
                        'body' => $release['body'],
                        'url' => $release['html_url'],
                        'published_at' => $release['published_at'],
                    ];
                }
            } catch (\Exception $e) {
                \Log::warning('GitHub Release Check failed: ' . $e->getMessage());
            }
            return null;
        });
    }

    /**
     * Pull latest updates from GitHub and clear cache.
     */
    public function pullUpdates()
    {
        try {
            // Check if git is available and configured
            $output = [];
            $resultCode = 0;

            // Execute git pull
            exec('git pull origin main 2>&1', $output, $resultCode);
            $gitOutput = implode("\n", $output);

            if ($resultCode !== 0) {
                return back()->withErrors(['error' => 'GitHub pull failed: ' . $gitOutput]);
            }

            // Execute optimize:clear
            \Illuminate\Support\Facades\Artisan::call('optimize:clear');
            $artisanOutput = \Illuminate\Support\Facades\Artisan::output();

            return back()->with('success', 'Successfully pulled updates from GitHub! Cache cleared.');

        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Update failed: ' . $e->getMessage()]);
        }
    }

    /**
     * Set multiple environment values within the .env file.
     *
     * @param  array  $values
     * @return void
     */
    private function setEnvValue(array $values)
    {
        $path = base_path('.env');

        if (file_exists($path)) {
            $currentEnv = file_get_contents($path);

            foreach ($values as $key => $value) {
                // If key exists, replace it, otherwise append
                if (preg_match("/^{$key}=.*/m", $currentEnv)) {
                    $currentEnv = preg_replace("/^{$key}=.*/m", "{$key}={$value}", $currentEnv);
                } else {
                    $currentEnv .= "\n{$key}={$value}\n";
                }
            }

            file_put_contents($path, $currentEnv);
        }
    }
}


