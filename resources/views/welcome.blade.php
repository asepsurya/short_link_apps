<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'ScrollWebLink') }} - Modern URL Shortener</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- hCaptcha -->
    <script src="https://js.hcaptcha.com/1/api.js" async defer></script>

    <style>
        @keyframes float {
            0% {
                transform: translateY(0px) rotate(0deg);
            }

            50% {
                transform: translateY(-20px) rotate(2deg);
            }

            100% {
                transform: translateY(0px) rotate(0deg);
            }
        }

        @keyframes float-reverse {
            0% {
                transform: translateY(0px) rotate(0deg);
            }

            50% {
                transform: translateY(20px) rotate(-2deg);
            }

            100% {
                transform: translateY(0px) rotate(0deg);
            }
        }

        .animate-float {
            animation: float 6s ease-in-out infinite;
        }

        .animate-float-delayed {
            animation: float-reverse 7s ease-in-out infinite;
        }

    </style>
</head>
<body class="font-sans antialiased text-gray-900 bg-[#FAFAFA] dark:bg-[#0B0B0E] dark:text-white selection:bg-purple-500 selection:text-white min-h-screen flex flex-col overflow-x-hidden">

    <!-- Navigation -->
    <nav class="w-full px-6 py-5 lg:px-12 flex justify-between items-center relative z-20">
        <div class="flex items-center gap-10">
            <a href="/" class="flex items-center gap-2 text-2xl font-extrabold tracking-tight">
                <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-purple-500 to-indigo-600 flex items-center justify-center text-white">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                    </svg>
                </div>
                ScrollWeb<span class="text-purple-600 font-bold">Link</span>
            </a>

            <div class="hidden md:flex gap-8 font-medium text-sm text-gray-600 dark:text-gray-300">
                <a href="#" class="hover:text-black dark:hover:text-white transition-colors">Features</a>
                <a href="#" class="hover:text-black dark:hover:text-white transition-colors">How It Works</a>
                <a href="#" class="hover:text-black dark:hover:text-white transition-colors">Pricing</a>
                <a href="#" class="hover:text-black dark:hover:text-white transition-colors">API</a>
            </div>
        </div>

        <div class="flex items-center gap-4">
            @if (Route::has('login'))
            @auth
            <a href="{{ url('/dashboard') }}" class="font-semibold text-sm px-6 py-2.5 rounded-full bg-black text-white dark:bg-white dark:text-black hover:scale-105 transition-transform">
                Dashboard
            </a>
            @else
            <a href="{{ route('login') }}" class="font-semibold text-sm hover:text-purple-600 transition-colors hidden sm:block">Log in</a>
            @if (Route::has('register'))
            <a href="{{ route('register') }}" class="font-semibold text-[15px] px-6 py-2.5 rounded-full bg-black text-white dark:bg-white dark:text-black hover:scale-105 hover:shadow-lg transition-transform transition-shadow">
                Sign Up
            </a>
            @endif
            @endauth
            @endif
        </div>
    </nav>

    <!-- Hero Section -->
    <main class="flex-1 flex flex-col items-center justify-center relative px-4 w-full h-[80vh] min-h-[600px]">
        <!-- Decorative blur background -->
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[500px] bg-purple-400/20 dark:bg-purple-900/20 rounded-[100%] blur-[100px] -z-10 pointer-events-none"></div>

        <div class="text-center z-10 max-w-4xl mx-auto">
            <div class="mt-4  text-gray-400 dark:text-gray-500 font-medium mb-5">
                By. <span class="italic text-purple-500">Asep Surya Somantri</span>
            </div>
            <h1 class="text-[50px] md:text-[75px] lg:text-[85px] leading-[1.05] font-extrabold tracking-tight mb-6">
                Don't just <span class="text-purple-500 italic font-serif mx-2">share</span> a link<br>
                start a relationship
            </h1>
            <p class="text-lg md:text-xl text-gray-500 dark:text-gray-400 mb-10 max-w-2xl mx-auto">
                ScrollWebLink lets you turn social media traffic into high-quality leads — with built-in tracking, custom slugs, and analytics.
            </p>

            <form action="{{ route('guest.link.store') }}" method="POST" class="max-w-lg mx-auto">
                @csrf

                <div class="flex flex-col sm:flex-row items-stretch gap-3">
                    <!-- Input Wrapper -->

                    <div class="flex items-center w-full bg-white dark:bg-[#1A1A22] border border-gray-200 dark:border-gray-800 rounded-full px-6 py-2 shadow-lg shadow-purple-900/5 hover:border-purple-300 dark:hover:border-purple-500/50 focus-within:ring-4 focus-within:ring-purple-500/20 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 dark:text-gray-500 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                        </svg>
                        <input type="url" name="original_url" placeholder="Paste your long link here" required class="flex-1 bg-transparent border-none outline-none text-base sm:text-lg font-medium text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none focus:ring-0 focus:border-transparent" />
                    </div>

                    <!-- Button -->
                    <button type="submit" class="bg-gradient-to-r from-purple-500 to-purple-600 text-white font-semibold px-8 py-3 rounded-full hover:scale-105 active:scale-95 transition-transform duration-200 whitespace-nowrap">
                        Shorten
                    </button>

                </div>




                <!-- Human Verification -->
                {{-- <div class="mt-6 flex justify-center">
                    <div class="h-captcha" data-sitekey="10000000-ffff-ffff-ffff-000000000001" data-theme="dark" data-size="normal"></div>
                </div> --}}
            </form>


            @if (session('guest_link'))
            <div class="mt-6 p-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-xl max-w-lg mx-auto flex items-center justify-between">
                <div>
                    <p class="text-xs text-green-600 dark:text-green-400 font-bold uppercase tracking-wider mb-1">Success!</p>
                    <a href="{{ session('guest_link') }}" target="_blank" class="text-lg font-bold text-gray-900 dark:text-white hover:underline">{{ str_replace(['http://', 'https://'], '', session('guest_link')) }}</a>
                </div>
                <button onclick="navigator.clipboard.writeText('{{ session('guest_link') }}'); alert('Copied!');" class="p-2 bg-white dark:bg-[#121217] rounded shadow-sm border border-gray-100 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">
                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"></path>
                    </svg>
                </button>
            </div>
            @endif

        </div>

        <!-- Left Floating Element -->
        <div class="hidden xl:block absolute left-[5%] top-[15%] w-72 animate-float pointer-events-none">
            <div class="bg-gradient-to-br from-orange-400 to-red-500 p-2 rounded-[32px] shadow-2xl transform -rotate-12">
                <div class="bg-white dark:bg-[#121217] rounded-[24px] h-[350px] p-4 flex flex-col items-center">
                    <div class="w-20 h-20 rounded-full bg-gray-200 mb-4 overflow-hidden border-4 border-white shadow-sm">
                        <img src="https://i.pravatar.cc/150?u=a042581f4e29026024d" alt="Avatar" class="w-full h-full object-cover">
                    </div>
                    <h3 class="font-bold text-lg">Detailed Analytics</h3>
                    <p class="text-xs text-gray-500 text-center mb-4">Track every single click on your links</p>

                    <div class="w-full space-y-2 mt-auto pb-2">
                        <div class="h-10 bg-gray-100 dark:bg-gray-800 rounded-xl w-full"></div>
                        <div class="h-10 bg-gray-100 dark:bg-gray-800 rounded-xl w-full"></div>
                        <div class="h-10 bg-gray-100 dark:bg-gray-800 rounded-xl w-full"></div>
                    </div>

                    <!-- Floating notification -->
                    <div class="absolute -right-10 top-1/2 bg-white dark:bg-gray-800 p-3 rounded-xl shadow-xl border border-gray-100 dark:border-gray-700 w-48">
                        <div class="flex flex-col gap-1">
                            <div class="w-full h-24 bg-gray-200 dark:bg-gray-700 rounded-lg mb-2"></div>
                            <h4 class="font-bold text-sm">Sesame St</h4>
                            <span class="text-xs text-purple-600 font-bold border border-purple-200 bg-purple-50 px-2 py-0.5 rounded w-max">Buy</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Social Icons -->
            <div class="absolute -left-4 -top-4 flex gap-2">
                <div class="w-10 h-10 bg-black rounded-full text-white flex items-center justify-center">𝕏</div>
                <div class="w-10 h-10 bg-black rounded-full text-white flex items-center justify-center">@</div>
            </div>
        </div>

        <!-- Right Floating Element -->
        <div class="hidden xl:block absolute right-[8%] top-[20%] w-64 animate-float-delayed pointer-events-none">
            <div class="bg-gradient-to-br from-purple-500 to-purple-800 p-1.5 rounded-[32px] shadow-2xl transform rotate-12">
                <div class="bg-white dark:bg-[#1A1A22] rounded-[28px] h-[320px] p-5 flex flex-col items-center relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-full h-24 bg-purple-100 dark:bg-purple-900/30"></div>
                    <div class="w-16 h-16 rounded-full bg-gray-200 mt-10 mb-3 z-10 border-4 border-white shadow relative">
                        <img src="https://i.pravatar.cc/150?img=11" alt="Avatar" class="w-full h-full object-cover rounded-full">
                    </div>
                    <h3 class="font-bold text-[17px] z-10">Alex Realtor</h3>
                    <div class="flex gap-2 mt-3 z-10 mb-6">
                        <div class="w-8 h-8 rounded-full bg-gray-100 dark:bg-gray-800 flex items-center justify-center text-sm">📱</div>
                        <div class="w-8 h-8 rounded-full bg-gray-100 dark:bg-gray-800 flex items-center justify-center text-sm">✉️</div>
                        <div class="w-8 h-8 rounded-full bg-gray-100 dark:bg-gray-800 flex items-center justify-center text-sm">🔗</div>
                    </div>

                    <button class="w-full mt-auto mb-2 bg-gradient-to-r from-purple-500 to-indigo-500 text-white font-bold py-3 rounded-2xl shadow-lg z-10">
                        Book Viewing
                    </button>
                </div>
            </div>
        </div>
    </main>

</body>
</html>
