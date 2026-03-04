<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class RedirectController extends Controller
{
    public function redirect(Request $request, $code)
    {
        /** @var \App\Models\Link $link */
        $link = Cache::remember('link_' . $code, 60 * 60, function () use ($code) {
            return Link::where('short_code', $code)->orWhere('custom_slug', $code)->firstOrFail();
        });

        // Check if expired
        if ($link->expires_at && $link->expires_at->isPast()) {
            abort(404, 'Link has expired.');
        }

        // Handle password protected links
        if ($link->password) {
            if (!$request->session()->has('link_unlocked_' . $link->id)) {
                return view('links.password', compact('link'));
            }
        }

        // Construct final URL with UTM tags if present
        $url = $link->original_url;
        $queryParams = [];

        if ($link->utm_source)
            $queryParams['utm_source'] = $link->utm_source;
        if ($link->utm_medium)
            $queryParams['utm_medium'] = $link->utm_medium;
        if ($link->utm_campaign)
            $queryParams['utm_campaign'] = $link->utm_campaign;
        if ($link->utm_term)
            $queryParams['utm_term'] = $link->utm_term;
        if ($link->utm_content)
            $queryParams['utm_content'] = $link->utm_content;

        if (!empty($queryParams)) {
            $separator = parse_url($url, PHP_URL_QUERY) ? '&' : '?';
            $url .= $separator . http_build_query($queryParams);
        }

        // Check if the link uses the redirect page countdown
        if ($link->use_redirect_page) {
            return view('links.redirect', ['redirectUrl' => $url]);
        }

        return redirect()->away($url, $link->redirect_type);
    }

    public function unlock(Request $request, Link $link)
    {
        if (password_verify($request->password, $link->password)) {
            $request->session()->put('link_unlocked_' . $link->id, true);
            return redirect()->route('redirect', $link->short_code);
        }

        return back()->withErrors(['password' => 'Incorrect password']);
    }
}
