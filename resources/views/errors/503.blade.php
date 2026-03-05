<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>503 - {{ __('Service Unavailable') }} | {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 antialiased dark:bg-gray-900 dark:text-gray-100 selection:bg-blue-500 selection:text-white">
    <div class="min-h-screen w-full lg:grid lg:grid-cols-2">
        <!-- Left Side -->
        <div class="flex flex-col justify-center px-6 py-12 sm:px-12 lg:px-24 xl:px-32 relative bg-white dark:bg-[#0B0B0E]">
            <div class="absolute top-8 left-8 sm:left-12 lg:left-12">
                <a href="/" class="flex items-center gap-2 text-xl font-bold text-gray-900 dark:text-white">
                    <div class="w-8 h-8 rounded-lg bg-blue-600 flex items-center justify-center text-white">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </div>
                    {{ \App\Models\Setting::get('platform.app_name', config('app.name', 'ScrollWebLink')) }}
                </a>
            </div>

            <div class="w-full max-w-md mx-auto text-center lg:text-left space-y-8">
                <div class="flex justify-center lg:justify-start">
                    <div class="w-20 h-20 bg-blue-500/10 rounded-2xl flex items-center justify-center text-blue-600 dark:text-blue-400">
                        <svg class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </div>
                </div>

                <div class="space-y-4">
                    <h1 class="text-7xl font-black bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent italic tracking-tighter">503</h1>
                    <h2 class="text-3xl font-bold text-gray-900 dark:text-white tracking-tight">{{ __('System is down for Maintenance') }}</h2>
                    <p class="text-gray-500 dark:text-gray-400 leading-relaxed max-w-sm mx-auto lg:mx-0">
                        {{ __('We\'re making the platform even better. We promise, we\'ll be right back!') }}
                    </p>
                </div>

                <div class="pt-6">
                    <button onclick="window.location.reload()" class="inline-flex items-center justify-center px-8 py-4 bg-blue-600 text-white font-bold rounded-2xl hover:bg-blue-700 transition-all shadow-xl shadow-blue-500/20 active:scale-95">
                        {{ __('Check Status') }}
                    </button>
                </div>
            </div>
        </div>

        <!-- Right Side -->
        <div class="hidden lg:flex flex-col justify-center items-center bg-blue-50 dark:bg-[#121217] relative overflow-hidden">
            <div class="absolute -top-24 -right-24 w-96 h-96 bg-blue-300 dark:bg-blue-900/40 rounded-full blur-3xl opacity-60"></div>
            <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-indigo-300 dark:bg-indigo-900/40 rounded-full blur-3xl opacity-60"></div>
            
            <div class="relative z-10 w-full max-w-md px-8">
                <div class="bg-white dark:bg-[#1A1A22] p-8 rounded-[30px] shadow-2xl border border-gray-100 dark:border-gray-800">
                    <div class="w-16 h-16 bg-blue-500/10 rounded-2xl flex items-center justify-center text-blue-600 mb-6">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold dark:text-white mb-4">{{ __('Scheduled Update') }}</h3>
                    <p class="text-gray-500 dark:text-gray-400 text-sm leading-relaxed mb-6">
                        {{ __('We perform regular maintenance to ensure maximum security and speed for your links. This usually takes just a few minutes.') }}
                    </p>
                    <div class="flex items-center gap-3 text-xs font-bold text-blue-600 uppercase tracking-widest">
                        <span>{{ __('Upgrading') }}</span>
                        <div class="w-2 h-2 rounded-full bg-blue-500 animate-ping"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
