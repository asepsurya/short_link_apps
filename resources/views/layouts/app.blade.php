<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'ScrollWebLink') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
                <div class="flex items-center gap-4">
                    <button class="p-2 rounded-full border border-gray-200 dark:border-gray-700 bg-white dark:bg-[#121217] text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white transition-colors relative shadow-sm">
                        <span class="absolute top-2 right-2.5 w-1.5 h-1.5 rounded-full bg-purple-500"></span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </header>
        @endisset

        <!-- Main Content Area -->
        <main class="flex-1 overflow-y-auto w-full p-4 lg:p-8 scroll-smooth" style="scrollbar-width: thin; scrollbar-color: #4B5563 transparent;">
            {{ $slot }}
        </main>
    </div>
</body>
</html>
