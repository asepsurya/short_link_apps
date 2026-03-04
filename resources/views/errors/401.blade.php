<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>401 - {{ __('Unauthorized') }} | {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 antialiased dark:bg-gray-900 dark:text-gray-100 selection:bg-red-500 selection:text-white">
    <div class="min-h-screen w-full lg:grid lg:grid-cols-2">
        <!-- Left Side -->
        <div class="flex flex-col justify-center px-6 py-12 sm:px-12 lg:px-24 xl:px-32 relative bg-white dark:bg-[#0B0B0E]">
            <div class="absolute top-8 left-8 sm:left-12 lg:left-12">
                <a href="/" class="flex items-center gap-2 text-xl font-bold text-gray-900 dark:text-white">
                    <div class="w-8 h-8 rounded-lg bg-red-600 flex items-center justify-center text-white">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    {{ Cache::get('platform.app_name', config('app.name', 'ScrollWebLink')) }}
                </a>
            </div>

            <div class="w-full max-w-md mx-auto text-center lg:text-left space-y-8">
                <div class="flex justify-center lg:justify-start">
                    <div class="w-20 h-20 bg-red-500/10 rounded-2xl flex items-center justify-center text-red-600 dark:text-red-400">
                        <svg class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                </div>

                <div class="space-y-4">
                    <h1 class="text-7xl font-black bg-gradient-to-r from-red-600 to-orange-600 bg-clip-text text-transparent italic tracking-tighter">401</h1>
                    <h2 class="text-3xl font-bold text-gray-900 dark:text-white tracking-tight">{{ __('Unauthorized') }}</h2>
                    <p class="text-gray-500 dark:text-gray-400 leading-relaxed max-w-sm mx-auto lg:mx-0">
                        {{ __('You do not have permission to access this resource. Please log in with an authorized account.') }}
                    </p>
                </div>

                <div class="pt-6 flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-8 py-4 bg-red-600 text-white font-bold rounded-2xl hover:bg-red-700 transition-all shadow-xl shadow-red-500/20 active:scale-95">
                        {{ __('Log in') }}
                    </a>
                    <a href="{{ url('/') }}" class="inline-flex items-center justify-center px-8 py-4 bg-gray-100 dark:bg-white/5 text-gray-900 dark:text-white font-bold rounded-2xl hover:bg-gray-200 dark:hover:bg-white/10 transition-all active:scale-95">
                        {{ __('Go back') }}
                    </a>
                </div>
            </div>
        </div>

        <!-- Right Side -->
        <div class="hidden lg:flex flex-col justify-center items-center bg-red-50 dark:bg-[#121217] relative overflow-hidden">
            <div class="absolute -top-24 -right-24 w-96 h-96 bg-red-300 dark:bg-red-900/40 rounded-full blur-3xl opacity-60"></div>
            <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-orange-300 dark:bg-orange-900/40 rounded-full blur-3xl opacity-60"></div>
            
            <div class="relative z-10 w-full max-w-md px-8">
                <div class="bg-white dark:bg-[#1A1A22] p-8 rounded-[30px] shadow-2xl border border-gray-100 dark:border-gray-800 text-center">
                    <div class="w-16 h-16 bg-red-500/10 rounded-2xl flex items-center justify-center text-red-600 mb-6 mx-auto">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.14l1.203-1.203a9.97 9.97 0 001.357-1.357M12 11V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold dark:text-white mb-4">{{ __('Restricted Area') }}</h3>
                    <p class="text-gray-500 dark:text-gray-400 text-sm leading-relaxed mb-6">
                        {{ __('This part of the platform is reserved for authenticated users or administrators only. Keep your account secure.') }}
                    </p>
                    <div class="flex items-center justify-center gap-3 text-xs font-bold text-red-600 uppercase tracking-widest">
                        <span>{{ __('Protected') }}</span>
                        <div class="w-2 h-2 rounded-full bg-red-500 animate-ping"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
