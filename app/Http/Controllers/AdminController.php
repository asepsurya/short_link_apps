<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
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

        $recentUsers = User::latest()->take(5)->get();

        return view('admin.dashboard', compact('totalUsers', 'totalLinks', 'totalClicks', 'recentUsers'));
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
}
