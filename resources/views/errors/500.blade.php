<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>500 - {{ __('Server Error') }} | {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 antialiased dark:bg-gray-900 dark:text-gray-100 selection:bg-orange-500 selection:text-white">
    <div class="min-h-screen w-full lg:grid lg:grid-cols-2">
        <!-- Left Side -->
        <div class="flex flex-col justify-center px-6 py-12 sm:px-12 lg:px-24 xl:px-32 relative bg-white dark:bg-[#0B0B0E]">
            <div class="absolute top-8 left-8 sm:left-12 lg:left-12">
                <a href="/" class="flex items-center gap-2 text-xl font-bold text-gray-900 dark:text-white">
                    <div class="w-8 h-8 rounded-lg bg-orange-600 flex items-center justify-center text-white">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    {{ \App\Models\Setting::get('platform.app_name', config('app.name', 'ScrollWebLink')) }}
                </a>
            </div>

            <div class="w-full max-w-md mx-auto text-center lg:text-left space-y-8">
                <div class="flex justify-center lg:justify-start">
                    <div class="w-20 h-20 bg-orange-500/10 rounded-2xl flex items-center justify-center text-orange-600 dark:text-orange-400">
                        <svg class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                </div>

                <div class="space-y-4">
                    <h1 class="text-7xl font-black bg-gradient-to-r from-orange-600 to-purple-600 bg-clip-text text-transparent italic tracking-tighter">500</h1>
                    <h2 class="text-3xl font-bold text-gray-900 dark:text-white tracking-tight">{{ __('This page isn\'t working') }}</h2>
                    <p class="text-gray-500 dark:text-gray-400 leading-relaxed max-w-sm mx-auto lg:mx-0">
                        {{ __('The server encountered an internal error. Don\'t worry, our engineers have been notified.') }}
                    </p>
                </div>

                <div class="pt-6 flex flex-col sm:flex-row gap-4">
                    <button onclick="window.location.reload()" class="inline-flex items-center justify-center px-8 py-4 bg-orange-600 text-white font-bold rounded-2xl hover:bg-orange-700 transition-all shadow-xl shadow-orange-500/20 active:scale-95">
                        {{ __('Refresh Page') }}
                    </button>
                    <a href="{{ url('/') }}" class="inline-flex items-center justify-center px-8 py-4 bg-gray-100 dark:bg-white/5 text-gray-900 dark:text-white font-bold rounded-2xl hover:bg-gray-200 dark:hover:bg-white/10 transition-all active:scale-95">
                        {{ __('Take me Home') }}
                    </a>
                </div>
            </div>
        </div>

        <!-- Right Side -->
        <div class="hidden lg:flex flex-col justify-center items-center bg-orange-50 dark:bg-[#121217] relative overflow-hidden">
            <div class="absolute -top-24 -left-24 w-96 h-96 bg-orange-300 dark:bg-orange-900/40 rounded-full blur-3xl opacity-60"></div>
            <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-purple-300 dark:bg-purple-900/40 rounded-full blur-3xl opacity-60"></div>
            
            <div class="relative z-10 w-full max-w-md px-8">
                <div class="bg-white dark:bg-[#1A1A22] p-8 rounded-[30px] shadow-2xl border border-gray-100 dark:border-gray-800">
                    <div class="w-16 h-16 bg-orange-500/10 rounded-2xl flex items-center justify-center text-orange-600 mb-6">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold dark:text-white mb-4">{{ __('Technical Glitch') }}</h3>
                    <p class="text-gray-500 dark:text-gray-400 text-sm leading-relaxed mb-6">
                        {{ __('Something broke on our end. We use real-time monitoring to catch these issues as they happen. Stay tuned.') }}
                    </p>
                    <div class="flex items-center gap-3 text-xs font-bold text-orange-600 uppercase tracking-widest">
                        <span>{{ __('Resolving') }}</span>
                        <div class="w-2 h-2 rounded-full bg-orange-500 animate-pulse"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
