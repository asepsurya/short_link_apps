<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>404 - {{ __('Not Found') }} | {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 antialiased dark:bg-gray-900 dark:text-gray-100 selection:bg-purple-500 selection:text-white">
    <div class="min-h-screen w-full lg:grid lg:grid-cols-2">
        <!-- Left Side / Content Area -->
        <div class="flex flex-col justify-center px-6 py-12 sm:px-12 lg:px-24 xl:px-32 relative bg-white dark:bg-[#0B0B0E]">
            <!-- Logo -->
            <div class="absolute top-8 left-8 sm:left-12 lg:left-12">
                <a href="/" class="flex items-center gap-2 text-xl font-bold text-gray-900 dark:text-white">
                    <div class="w-8 h-8 rounded-lg bg-purple-600 flex items-center justify-center text-white">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                        </svg>
                    </div>
                    {{ Cache::get('platform.app_name', config('app.name', 'ScrollWebLink')) }}
                </a>
            </div>

            <div class="w-full max-w-md mx-auto text-center lg:text-left space-y-8">
                <!-- Icon -->
                <div class="flex justify-center lg:justify-start">
                    <div class="w-20 h-20 bg-purple-500/10 rounded-2xl flex items-center justify-center text-purple-600 dark:text-purple-400">
                        <svg class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </div>

                <div class="space-y-4">
                    <h1 class="text-7xl font-black bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent italic tracking-tighter">404</h1>
                    <h2 class="text-3xl font-bold text-gray-900 dark:text-white tracking-tight">{{ __('Something went wrong') }}</h2>
                    <p class="text-gray-500 dark:text-gray-400 leading-relaxed max-w-sm mx-auto lg:mx-0">
                        {{ __('Sorry, we were unable to find that page. It might have been moved or doesn\'t exist anymore.') }}
                    </p>
                </div>

                <div class="pt-6 flex flex-col sm:flex-row gap-4">
                    <a href="{{ url('/') }}" class="inline-flex items-center justify-center px-8 py-4 bg-purple-600 text-white font-bold rounded-2xl hover:bg-purple-700 transition-all shadow-xl shadow-purple-500/20 active:scale-95">
                        {{ __('Back to Home') }}
                    </a>
                    <a href="{{ url('/dashboard') }}" class="inline-flex items-center justify-center px-8 py-4 bg-gray-100 dark:bg-white/5 text-gray-900 dark:text-white font-bold rounded-2xl hover:bg-gray-200 dark:hover:bg-white/10 transition-all active:scale-95">
                        {{ __('Dashboard') }}
                    </a>
                </div>
            </div>
        </div>

        <!-- Right Side / Branding (Mirroring Guest Layout) -->
        <div class="hidden lg:flex flex-col justify-center items-center bg-purple-50 dark:bg-[#121217] relative overflow-hidden">
            <div class="absolute -top-24 -right-24 w-96 h-96 bg-purple-300 dark:bg-purple-900/40 rounded-full blur-3xl opacity-60"></div>
            <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-indigo-300 dark:bg-indigo-900/40 rounded-full blur-3xl opacity-60"></div>
            <div class="absolute right-0 top-1/2 -translate-y-1/2 translate-x-1/2 w-[800px] h-[800px] bg-purple-600/10 dark:bg-purple-500/10 rounded-full blur-3xl"></div>

            <div class="relative z-10 w-full max-w-md px-8">
                <div class="bg-white dark:bg-[#1A1A22] p-8 rounded-[30px] shadow-2xl border border-gray-100 dark:border-gray-800">
                    <div class="w-16 h-16 bg-purple-500/10 rounded-2xl flex items-center justify-center text-purple-600 mb-6">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold dark:text-white mb-4">{{ __('Lost in space?') }}</h3>
                    <p class="text-gray-500 dark:text-gray-400 text-sm leading-relaxed mb-6">
                        {{ __('Don\'t worry, even the best travelers get lost sometimes. Let\'s get you back on track to your shortening journey.') }}
                    </p>
                    <div class="flex items-center gap-3 text-xs font-bold text-purple-600 uppercase tracking-widest">
                        <span>{{ __('Operational') }}</span>
                        <div class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></div>
                    </div>
                </div>

                <div class="mt-8">
                    <p class="text-xs text-gray-500 dark:text-gray-400 opacity-60">
                        {{ config('app.name') }} &copy; {{ date('Y') }} — {{ __('The link management platform for everyone.') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
