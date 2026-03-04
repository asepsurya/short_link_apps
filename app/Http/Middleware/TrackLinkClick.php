<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackLinkClick
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // We only track successful redirects
        if ($response->isRedirection()) {
            $code = $request->route('code');
            if ($code) {
                $link = \App\Models\Link::where('short_code', $code)->orWhere('custom_slug', $code)->first();
                if ($link && (!$link->password || $request->session()->has('link_unlocked_' . $link->id))) {
                    $agent = new \Jenssegers\Agent\Agent();
                    $agent->setUserAgent($request->header('User-Agent'));

                    \App\Models\LinkClick::create([
                        'link_id' => $link->id,
                        'ip_address' => $request->ip(),
                        'country' => null, // Would require geoip package
                        'city' => null,
                        'device_type' => $agent->isMobile() ? 'Mobile' : ($agent->isTablet() ? 'Tablet' : 'Desktop'),
                        'browser' => $agent->browser(),
                        'platform' => $agent->platform(),
                        'referer' => $request->header('referer'),
                    ]);

                    $link->increment('clicks_count');
                }
            }
        }

        return $response;
    }
}
