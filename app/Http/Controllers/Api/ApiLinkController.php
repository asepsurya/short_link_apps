<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ApiLinkController extends Controller
{
    /**
     * Display a listing of the authenticated user's links.
     */
    public function index(Request $request)
    {
        $links = $request->user()->links()->latest()->paginate(15);

        return response()->json([
            'success' => true,
            'data' => $links
        ]);
    }

    /**
     * Store a newly created link in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'original_url' => 'required|url',
            'custom_slug' => 'nullable|string|max:20|unique:links,code',
            'password' => 'nullable|string|max:255',
            'expires_at' => 'nullable|date|after:now',
            'use_redirect_page' => 'nullable|boolean',
        ]);

        $code = $validated['custom_slug'] ?? Str::random(6);

        $link = Link::create([
            'user_id' => $request->user()->id,
            'original_url' => $validated['original_url'],
            'code' => $code,
            'password' => $validated['password'],
            'expires_at' => $validated['expires_at'],
            'use_redirect_page' => $validated['use_redirect_page'] ?? true,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Link created successfully',
            'data' => $link
        ], 201);
    }

    /**
     * Display the specified link.
     */
    public function show(Link $link)
    {
        if ($link->user_id !== Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 403);
        }

        return response()->json([
            'success' => true,
            'data' => $link
        ]);
    }

    /**
     * Update the specified link in storage.
     */
    public function update(Request $request, Link $link)
    {
        if ($link->user_id !== $request->user()->id) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 403);
        }

        $validated = $request->validate([
            'original_url' => 'sometimes|required|url',
            'custom_slug' => 'sometimes|nullable|string|max:20|unique:links,code,' . $link->id,
            'password' => 'nullable|string|max:255',
            'expires_at' => 'nullable|date|after:now',
            'use_redirect_page' => 'nullable|boolean',
        ]);

        if (isset($validated['custom_slug'])) {
            $validated['code'] = $validated['custom_slug'];
            unset($validated['custom_slug']);
        }

        $link->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Link updated successfully',
            'data' => $link
        ]);
    }

    /**
     * Remove the specified link from storage.
     */
    public function destroy(Request $request, Link $link)
    {
        if ($link->user_id !== $request->user()->id) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 403);
        }

        $link->delete();

        return response()->json([
            'success' => true,
            'message' => 'Link deleted successfully'
        ]);
    }

    /**
     * Get click statistics for a specific link.
     */
    public function stats(Request $request, Link $link)
    {
        if ($link->user_id !== $request->user()->id) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 403);
        }

        $stats = [
            'total_clicks' => $link->clicks()->count(),
            'clicks_by_date' => $link->clicks()
            ->selectRaw('DATE(created_at) as date, count(*) as count')
            ->groupBy('date')
            ->orderBy('date', 'desc')
            ->get(),
            'clicks_by_country' => $link->clicks()
            ->selectRaw('country, count(*) as count')
            ->groupBy('country')
            ->get(),
            'clicks_by_device' => $link->clicks()
            ->selectRaw('device, count(*) as count')
            ->groupBy('device')
            ->get(),
        ];

        return response()->json([
            'success' => true,
            'data' => $stats
        ]);
    }
}
