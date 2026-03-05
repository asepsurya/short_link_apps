<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class LinkController extends Controller
{
    public function index()
    {
        $links = auth()->user()->links()->latest()->paginate(10);
        return view('links.index', compact('links'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'original_url' => 'required|url|max:2000',
            'custom_slug' => 'nullable|string|alpha_dash|max:255|unique:links,custom_slug',
            'redirect_type' => 'nullable|in:301,302',
            'password' => 'nullable|string|min:4',
            'expires_at' => 'nullable|date|after:now',
            'utm_source' => 'nullable|string|max:255',
            'utm_medium' => 'nullable|string|max:255',
            'utm_campaign' => 'nullable|string|max:255',
            'use_redirect_page' => 'nullable|boolean',
        ]);

        $shortCode = $validated['custom_slug'] ?? Str::random(6);

        // Ensure uniqueness if not custom
        if (empty($validated['custom_slug'])) {
            while (Link::where('short_code', $shortCode)->exists()) {
                $shortCode = Str::random(6);
            }
        }

        $link = auth()->user()->links()->create([
            'uuid' => Str::uuid(),
            'original_url' => $validated['original_url'],
            'short_code' => $shortCode,
            'custom_slug' => $validated['custom_slug'] ?? null,
            'password' => !empty($validated['password']) ? bcrypt($validated['password']) : null,
            'redirect_type' => $validated['redirect_type'] ?? 302,
            'expires_at' => $validated['expires_at'] ? Carbon::parse($validated['expires_at']) : null,
            'utm_source' => $validated['utm_source'] ?? null,
            'utm_medium' => $validated['utm_medium'] ?? null,
            'utm_campaign' => $validated['utm_campaign'] ?? null,
            'use_redirect_page' => $request->boolean('use_redirect_page', true),
        ]);

        return redirect()->route('links.index')->with('success', 'Short link created successfully!');
    }

    public function edit(Link $link)
    {
        if ($link->user_id !== auth()->id())
            abort(403);
        return view('links.edit', compact('link'));
    }

    public function update(Request $request, Link $link)
    {
        if ($link->user_id !== auth()->id())
            abort(403);

        $validated = $request->validate([
            'original_url' => 'required|url|max:2000',
            'redirect_type' => 'nullable|in:301,302',
            'expires_at' => 'nullable|date',
            'password' => 'nullable|string|min:4',
            'use_redirect_page' => 'nullable|boolean',
        ]);

        $data = [
            'original_url' => $validated['original_url'],
            'redirect_type' => $validated['redirect_type'] ?? 302,
            'expires_at' => isset($validated['expires_at']) ? Carbon::parse($validated['expires_at']) : null,
            'use_redirect_page' => $request->boolean('use_redirect_page', false),
        ];

        if ($request->filled('password')) {
            $data['password'] = bcrypt($validated['password']);
        } elseif ($request->has('remove_password')) {
            $data['password'] = null;
        }

        $link->update($data);

        // Clear cache
        Cache::forget('link_' . $link->short_code);
        if ($link->custom_slug) {
            Cache::forget('link_' . $link->custom_slug);
        }

        return redirect()->route('links.index')->with('success', 'Link updated successfully.');
    }

    public function destroy(Link $link)
    {
        if ($link->user_id !== auth()->id())
            abort(403);
        Cache::forget('link_' . $link->short_code);
        if ($link->custom_slug) {
            Cache::forget('link_' . $link->custom_slug);
        }
        $link->delete();
        return redirect()->route('links.index')->with('success', 'Link deleted successfully.');
    }

    /**
     * Generate a short link for a guest (unauthenticated) user. 
     * The link will automatically expire in 3 days.
     */
    public function guestStore(Request $request)
    {
        if (!\App\Models\Setting::get('platform.enable_guest_links', true)) {
            return back()->with('error', 'Public link creation is currently disabled.');
        }

        $validated = $request->validate([
            'original_url' => 'required|url|max:2000',
            'h-captcha-response' => 'required',
        ], [
            'h-captcha-response.required' => __('Please complete the captcha verification.'),
        ]);

        // Verify hCaptcha
        $response = Http::withoutVerifying()->asForm()->post('https://hcaptcha.com/siteverify', [
            'secret' => \App\Models\Setting::get('platform.hcaptcha_secret', env('HCAPTCHA_SECRET')),
            'response' => $request->input('h-captcha-response'),
            'remoteip' => $request->ip(),
        ]);

        if (!$response->json('success')) {
            return back()->withErrors(['h-captcha-response' => 'Please complete the captcha verification.']);
        }

        $shortCode = Str::random(6);
        while (Link::where('short_code', $shortCode)->exists()) {
            $shortCode = Str::random(6);
        }

        $link = Link::create([
            'uuid' => Str::uuid(),
            'user_id' => null,
            'creator_ip' => $request->ip(),
            'original_url' => $validated['original_url'],
            'short_code' => $shortCode,
            'redirect_type' => 302,
            'expires_at' => Carbon::now()->addDays(3),
            'use_redirect_page' => $request->boolean('use_redirect_page', true),
        ]);

        return redirect('/')
            ->with('guest_link', url($link->short_code));
    }
}
