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

        $recentUsers = User::latest()->take(5)->get();
        $guestLinks = Link::whereNull('user_id')->latest()->paginate(10, ['*'], 'guest_page');

        return view('admin.dashboard', compact('totalUsers', 'totalLinks', 'totalClicks', 'totalApiRequests', 'recentUsers', 'guestLinks'));
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
            'app_name' => 'required|string|max:255',
            'footer_text' => 'nullable|string|max:255',
            'primary_color' => 'nullable|string|max:7', // Hex color
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string|max:255',
            'redirect_duration' => 'nullable|integer|min:0|max:60',
            'analytics_script' => 'nullable|string',
            'adsense_script' => 'nullable|string',
            'app_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
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

        return back()->with('success', 'Application settings updated successfully.');
    }
}
