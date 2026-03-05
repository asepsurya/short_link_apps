<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ Cache::get('platform.meta_title', config('app.name', 'ScrollWebLink')) }}</title>
    <meta name="description" content="{{ Cache::get('platform.meta_description', 'Shorten URLs and track clicks with our powerful platform.') }}">
    <meta name="keywords" content="{{ Cache::get('platform.meta_keywords', 'url shortener, link tracker, analytics') }}">

    @if(Cache::has('platform.logo_path'))
        <link rel="icon" href="{{ asset('storage/' . Cache::get('platform.logo_path')) }}">
    @endif
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Custom Integrations -->
    {!! Cache::get('platform.analytics_script') !!}
    {!! Cache::get('platform.adsense_script') !!}
</head>
<body class="font-sans antialiased text-gray-900 bg-[#FAFAFA] dark:bg-[#0B0B0E] dark:text-gray-100 flex h-screen overflow-hidden selection:bg-purple-500 selection:text-white">

    <!-- Sidebar Navigation -->
    @include('layouts.navigation')

    <!-- Main Content Wrapper -->
    <div class="flex-1 flex flex-col h-screen overflow-hidden relative">

        <!-- Mobile Header -->
        <div class="lg:hidden flex items-center justify-between p-4 bg-white dark:bg-[#121217] border-b border-gray-200 dark:border-gray-800">
            <a href="{{ route('dashboard') }}" class="text-xl font-bold flex items-center gap-2 text-gray-900 dark:text-white">
                <div class="w-8 h-8 rounded bg-purple-600 flex items-center justify-center text-white">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                    </svg>
                </div>
            </a>
            <button type="button" class="text-gray-500 hover:text-gray-900 dark:hover:text-white focus:outline-none" onclick="document.getElementById('sidebar').classList.toggle('-translate-x-full')">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>

        <!-- Page Header -->
        @isset($header)
        <header class="bg-white/90 dark:bg-[#0B0B0E]/90 backdrop-blur-md border-b border-gray-200 dark:border-gray-800 z-10 sticky top-0">
            <div class="py-4 px-6 lg:px-8 flex justify-between items-center">
                <div class="flex-1 text-gray-900 dark:text-white">
                    {{ $header }}
                </div>
                <!-- <div class="flex items-center gap-4">
                    <button class="p-2 rounded-full border border-gray-200 dark:border-gray-700 bg-white dark:bg-[#121217] text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white transition-colors relative shadow-sm">
                        <span class="absolute top-2 right-2.5 w-1.5 h-1.5 rounded-full bg-purple-500"></span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                        </svg>
                    </button>
                </div> -->
            </div>
        </header>
        @endisset

        <!-- Main Content Area -->
        <main class="flex-1 overflow-y-auto w-full {{ request()->routeIs('admin.settings') ? '' : 'p-4 lg:p-8' }} scroll-smooth" style="scrollbar-width: thin; scrollbar-color: #4B5563 transparent;">
            <div class="min-h-full flex flex-col">
                <div class="flex-1">
                    {{ $slot }}
                </div>
                
             
            </div>
        </main>
           <!-- 
                    =========================================================
                    WARNING: DO NOT REMOVE OR MODIFY THIS COPYRIGHT NOTICE 
                    WITHOUT EXPLICIT PERMISSION FROM THE ORIGINAL AUTHOR.
                    =========================================================
                -->
                <footer class="mt-auto px-4 lg:px-8 py-6 mt-8 border-t border-gray-200 dark:border-gray-800 flex flex-col md:flex-row items-center justify-between gap-4">
                    <p class="text-xs text-gray-500 dark:text-gray-400">
                        &copy; {{ date('Y') }} <span class="font-semibold text-gray-900 dark:text-white"><a href="https://scrollwebid.com" target="_blank" rel="noopener noreferrer">bt.scrollwebid</a></span>. All rights reserved.
                    </p>
                    <p class="text-xs text-gray-400 dark:text-gray-500 flex items-center gap-1.5">
                        Designed & Developed by
                        <a href="https://github.com/asepsurya" target="_blank" class="font-medium text-purple-600 dark:text-purple-400 hover:text-purple-700 dark:hover:text-purple-300 transition-colors inline-flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="currentColor">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C6.477 2 2 6.477 2 12c0 4.42 2.865 8.166 6.839 9.489.5.092.682-.217.682-.482 0-.237-.008-.866-.013-1.7-2.782.603-3.369-1.34-3.369-1.34-.454-1.156-1.11-1.462-1.11-1.462-.908-.62.069-.608.069-.608 1.003.07 1.531 1.03 1.531 1.03.892 1.529 2.341 1.087 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.11-4.555-4.943 0-1.091.39-1.984 1.029-2.683-.103-.253-.446-1.27.098-2.647 0 0 .84-.269 2.75 1.025A9.564 9.564 0 0112 6.844c.85.004 1.705.114 2.504.336 1.909-1.294 2.747-1.025 2.747-1.025.546 1.377.203 2.394.1 2.647.64.699 1.028 1.592 1.028 2.683 0 3.842-2.339 4.687-4.566 4.935.359.309.678.919.678 1.852 0 1.336-.012 2.415-.012 2.743 0 .267.18.578.688.48C19.138 20.161 22 16.418 22 12c0-5.523-4.477-10-10-10z"></path>
                            </svg>
                            asep.surya.s
                        </a>
                    </p>
                </footer>
    </div>
</body>
</html>
