<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckInstallation
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $installed = env('APP_INSTALLED', false);

        // If not installed and not currently on an install route, redirect to install
        if (!$installed && !$request->is('install*')) {
            return redirect()->route('install.index');
        }

        // If installed and trying to access install route, redirect to home
        if ($installed && $request->is('install*')) {
            return redirect('/');
        }

        return $next($request);
    }
}
