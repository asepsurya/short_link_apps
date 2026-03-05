<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    @if(Cache::has('platform.logo_path'))
        <link rel="icon" href="{{ asset('storage/' . Cache::get('platform.logo_path')) }}">
    @endif
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 antialiased dark:bg-gray-900 dark:text-gray-100 selection:bg-purple-500 selection:text-white">
    <div class="min-h-screen w-full lg:grid lg:grid-cols-2">
        <!-- Left Side / Form Area -->
        <div class="min-h-screen flex flex-col justify-center px-6 py-12 sm:px-12 lg:px-24 xl:px-32 relative bg-white dark:bg-[#0B0B0E]">
            <!-- Logo -->
            <div class="absolute top-8 left-8 sm:left-12 lg:left-12">
                <a href="/" class="flex items-center gap-2 text-xl font-bold text-gray-900 dark:text-white">
                    <div class="w-8 h-8 rounded-lg bg-purple-600 flex items-center justify-center text-white">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                        </svg>
                    </div>
                    ScrollWebLink
                </a>
            </div>

            <div class="w-full max-w-md mx-auto">
                {{ $slot }}
            </div>
        </div>

        <!-- Right Side / Branding -->

        <div class="hidden lg:flex flex-col justify-center items-center bg-purple-50 dark:bg-[#121217] relative overflow-hidden">
            <!-- Abstract Background Shapes -->
            <div class="absolute -top-24 -right-24 w-96 h-96 bg-purple-300 dark:bg-purple-900/40 rounded-full blur-3xl opacity-60"></div>
            <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-indigo-300 dark:bg-indigo-900/40 rounded-full blur-3xl opacity-60"></div>

            <div class="absolute right-0 top-1/2 -translate-y-1/2 translate-x-1/2 w-[800px] h-[800px] bg-purple-600/10 dark:bg-purple-500/10 rounded-full blur-3xl"></div>

            <div class="relative z-10 w-full max-w-md px-8">
                <!-- Preview Card imitating the reference -->
                <div class="bg-white dark:bg-[#1A1A22] p-4 rounded-[20px] shadow-2xl shadow-purple-900/10 dark:shadow-black/50 overflow-hidden relative border border-gray-100 dark:border-gray-800">
                    <!-- Decorative Tag -->
                    <div class="absolute top-8 -left-2 bg-purple-600 text-white text-[10px] tracking-wider font-bold px-3 py-1.5 rounded-r-md shadow-md z-20 flex items-center gap-1 uppercase">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                        Free Forever
                    </div>
                    <!-- Mock Image/Banner -->
                    <div class="w-full h-48 bg-gradient-to-br from-purple-500 via-indigo-500 to-purple-800 rounded-xl mb-5 relative overflow-hidden flex items-center justify-center">
                        <div class="absolute inset-0 bg-white/10 dark:bg-black/20 backdrop-blur-sm"></div>

                        <!-- Link Icon placeholder -->
                        <svg class="w-20 h-20 text-white/80 drop-shadow-lg" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                        </svg>
                    </div>
                    <!-- Mock Content -->
                    <div class="px-2 pb-2">
                        <div class="flex justify-between items-start mb-3">
                            <div>
                                <h3 class="font-bold text-gray-900 dark:text-white text-[19px] leading-tight mb-1">Simplify Your Links</h3>
                                <p class="text-[13px] text-gray-500 dark:text-gray-400">Create, shorten and track your links with ease</p>
                            </div>
                            <div class="w-9 h-9 rounded-full border border-gray-200 dark:border-gray-700 flex items-center justify-center text-purple-600 dark:text-purple-400 hover:bg-purple-50 dark:hover:bg-purple-900/20 cursor-pointer transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                            </div>
                        </div>

                        <div class="flex items-center gap-4 text-[13px] tracking-tight text-gray-500 dark:text-gray-400 font-medium mb-6 mt-5">
                            <span class="flex items-center gap-1.5"><svg class="w-4 h-4 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg> Analytics</span>
                            <span class="flex items-center gap-1.5"><svg class="w-4 h-4 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                </svg> Custom Slugs</span>
                            <span class="flex items-center gap-1.5"><svg class="w-4 h-4 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1l-1 1h2l-1 1v3M8 4h8a2 2 0 012 2v12a2 2 0 01-2 2H8a2 2 0 01-2-2V6a2 2 0 012-2z"></path>
                                </svg> QR Codes</span>
                        </div>

                        <div class="flex items-center justify-between border-t border-gray-100 dark:border-gray-800 pt-5 pb-1">
                            <div>
                                <p class="text-xs text-gray-500 dark:text-gray-400 font-medium mb-0.5">Start For</p>
                                <p class="text-2xl font-bold text-purple-600 dark:text-purple-400">$0<span class="text-[13px] text-gray-500 dark:text-gray-400 font-normal">/month</span></p>
                            </div>
                            <button class="bg-[#11111A] dark:bg-purple-600 text-white px-5 py-2.5 rounded-lg text-sm font-semibold flex items-center gap-2 hover:bg-purple-600 dark:hover:bg-purple-500 transition-colors shadow-md">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                Create Link
                            </button>
                        </div>
                    </div>
                </div>

                <div class="mt-8 relative z-10">
                    <p class="flex items-center gap-1.5 text-sm font-bold text-gray-800 dark:text-gray-300">Powered by <div class="w-5 h-5 bg-purple-600 rounded flex items-center justify-center text-white"><svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656-1.1 1.1"></path>
                            </svg></div>
                    </p>
                    <p class="mt-3 text-xs leading-relaxed text-gray-500 dark:text-gray-400 opacity-80 max-w-sm">By using ScrollWebLink, you agree to our <a href="#" class="text-purple-600 dark:text-purple-400 hover:underline">Terms of Service</a> and <a href="#" class="text-purple-600 dark:text-purple-400 hover:underline">Privacy Policy</a>. We ensure your data is protected and your links are always accessible.</p>
                </div>
            </div>
        </div>

    </div>
</body>
</html>
