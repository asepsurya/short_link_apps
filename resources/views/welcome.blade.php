<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ Cache::get('platform.meta_title', config('app.name', 'ScrollWebLink')) }}</title>
    <meta name="description" content="{{ Cache::get('platform.meta_description', __('meta.description')) }}">
    <meta name="keywords" content="{{ Cache::get('platform.meta_keywords', __('meta.keywords')) }}">

    @if(Cache::has('platform.logo_path'))
    <link rel="icon" href="{{ asset('storage/' . Cache::get('platform.logo_path')) }}">
    @endif
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- hCaptcha -->
    <script src="https://js.hcaptcha.com/1/api.js" async defer></script>

    <!-- Custom Integrations -->
    {!! Cache::get('platform.analytics_script') !!}
    {!! Cache::get('platform.adsense_script') !!}

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

        html {
            scroll-behavior: smooth;
        }

        .animate-float {
            animation: float 6s ease-in-out infinite;
        }

        .animate-float-delayed {
            animation: float-reverse 7s ease-in-out infinite;
        }

        [x-cloak] {
            display: none !important;
        }

    </style>
</head>
<body class="font-sans antialiased text-gray-900 bg-[#FAFAFA] dark:bg-[#0B0B0E] dark:text-white selection:bg-purple-500 selection:text-white min-h-screen flex flex-col overflow-x-hidden">

    <!-- Navigation -->
    <nav class="w-full px-6 py-5 lg:px-12 flex justify-between items-center relative z-20">
        <div class="flex items-center gap-10">
            @php
            $appName = Cache::get('platform.app_name', config('app.name', 'ScrollWebLink'));
            $primaryColor = Cache::get('platform.primary_color', '#7c3aed');
            $hasLink = \Illuminate\Support\Str::contains($appName, 'Link');
            $beforeLink = $hasLink ? \Illuminate\Support\Str::beforeLast($appName, 'Link') : $appName;
            @endphp
            <a href="/" class="flex items-center gap-2 text-2xl font-extrabold tracking-tight">
                @if(Cache::has('platform.logo_path'))
                <img src="{{ asset('storage/' . Cache::get('platform.logo_path')) }}" class="w-10 h-10 object-contain">
                @else
                <div class="w-8 h-8 rounded-lg flex items-center justify-center text-white" style="background: linear-gradient(135deg, {{ $primaryColor }}, #4f46e5)">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                    </svg>
                </div>
                @endif
                {{ $beforeLink }}<span style="color: {{ $primaryColor }}">{{ $hasLink ? 'Link' : '' }}</span>
            </a>

            <div class="hidden md:flex gap-8 font-medium text-sm text-gray-600 dark:text-gray-300">
                <a href="#how-it-works" class="hover:text-black dark:hover:text-white transition-colors">{{ __('How It Works') }}</a>
                <a href="#pricing" class="hover:text-black dark:hover:text-white transition-colors">{{ __('Pricing') }}</a>
                <a href="#api" class="hover:text-black dark:hover:text-white transition-colors">{{ __('API') }}</a>
                <a href="{{ route('docs') }}" class="hover:text-black dark:hover:text-white transition-colors">{{ __('Documentation') }}</a>
            </div>
        </div>

        <div class="flex items-center gap-4">
            <!-- Language Badges -->
            <div class="hidden sm:flex items-center backdrop-blur-md bg-white/50 dark:bg-[#1A1A22]/30 rounded-full p-1 border border-gray-200 dark:border-white/10 shadow-sm mr-2">
                <a href="{{ route('lang.switch', 'id') }}" class="px-3 py-1 rounded-full text-[10px] font-black transition-all {{ App::getLocale() == 'id' ? 'bg-purple-600 text-white shadow-lg' : 'text-gray-500 dark:text-gray-400 hover:text-purple-600' }}">ID</a>
                <a href="{{ route('lang.switch', 'en') }}" class="px-3 py-1 rounded-full text-[10px] font-black transition-all {{ App::getLocale() == 'en' ? 'bg-purple-600 text-white shadow-lg' : 'text-gray-500 dark:text-gray-400 hover:text-purple-600' }}">EN</a>
            </div>

            @if (Route::has('login'))
            @auth
            <a href="{{ url('/dashboard') }}" class="font-semibold text-sm px-6 py-2.5 rounded-full bg-black text-white dark:bg-white dark:text-black hover:scale-105 transition-transform">
                {{ __('Dashboard') }}
            </a>
            @else
            <a href="{{ route('login') }}" class="font-semibold text-sm hover:text-purple-600 transition-colors hidden sm:block">{{ __('Log in') }}</a>
            @if (Route::has('register'))
            <a href="{{ route('register') }}" class="font-semibold text-[15px] px-6 py-2.5 rounded-full bg-black text-white dark:bg-white dark:text-black hover:scale-105 hover:shadow-lg transition-transform transition-shadow">
                {{ __('Sign Up') }}
            </a>
            @endif
            @endauth
            @endif
        </div>
    </nav>

    <!-- Hero Section -->
    <main class="flex-1 flex flex-col items-center justify-center relative px-6 py-12 md:py-24 lg:py-32 w-full min-h-[calc(100vh-100px)]">
        <!-- Decorative blur background -->
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[500px] bg-purple-400/20 dark:bg-purple-900/20 rounded-[100%] blur-[100px] -z-10 pointer-events-none"></div>

        <div class="text-center z-10 max-w-5xl mx-auto">

            <div x-data="{ 
                active: 0,
                 phrases: [
                    { 
                        main: `{{ __("hero.phrase_1_main") }}`, 
                        sub: `{{ __("hero.phrase_1_sub") }}` 
                    },
                    { 
                        main: `{{ __("hero.phrase_2_main") }}`, 
                        sub: `{{ __("hero.phrase_2_sub") }}` 
                    },
                    { 
                        main: `{{ __("hero.phrase_3_main") }}`, 
                        sub: `{{ __("hero.phrase_3_sub") }}` 
                    }
                ],
                init() {
                    setInterval(() => {
                        this.active = (this.active + 1) % this.phrases.length;
                    }, 4000);
                }
            }" class="h-[140px] xs:h-[160px] md:h-[220px] lg:h-[240px] flex items-center justify-center overflow-hidden mb-8 relative">
                <template x-for="(phrase, index) in phrases" :key="index">
                    <div x-show="active === index" x-transition:enter="transition ease-out duration-1000" x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-500 absolute" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-8" class="text-[28px] xs:text-[42px] md:text-[75px] lg:text-[85px] leading-[1.1] font-extrabold tracking-tight text-center">
                        <div x-html="phrase.main" class="whitespace-nowrap"></div>
                        <div x-html="phrase.sub" class="whitespace-nowrap"></div>
                    </div>
                </template>
            </div>
            <form id="shorten-form" action="{{ Cache::get('platform.enable_guest_links', true) ? route('guest.link.store') : route('login') }}" method="{{ Cache::get('platform.enable_guest_links', true) ? 'POST' : 'GET' }}" class="max-w-2xl mx-auto mb-10" onsubmit="{{ Cache::get('platform.enable_guest_links', true) ? 'return validateCaptcha()' : '' }}" x-data="{ 
                    showCaptcha: {{ $errors->has('h-captcha-response') ? 'true' : 'false' }},
                    captchaError: '{{ $errors->first('h-captcha-response') }}',
                    guestEnabled: {{ Cache::get('platform.enable_guest_links', true) ? 'true' : 'false' }}
                }">
                @csrf

                <div class="flex flex-col sm:flex-row items-stretch gap-3">
                    <!-- Input Wrapper -->

                    <div class="flex items-center w-full bg-white dark:bg-[#1A1A22] border border-gray-200 dark:border-gray-800 rounded-full px-6 py-2.5 shadow-lg shadow-purple-900/5 hover:border-purple-300 dark:hover:border-purple-500/50 focus-within:ring-4 focus-within:ring-purple-500/20 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 dark:text-gray-500 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                        </svg>
                        <input type="url" name="original_url" placeholder="{{ __('Paste your long link here') }}" required @focus="if(guestEnabled) showCaptcha = true" class="flex-1 bg-transparent border-none outline-none text-base sm:text-lg font-medium text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none focus:ring-0 focus:border-transparent" />
                    </div>

                    <!-- Button -->
                    <button type="submit" class="bg-gradient-to-r from-purple-500 to-purple-600 text-white font-bold p-4 rounded-full hover:scale-105 active:scale-95 transition-all duration-200 whitespace-nowrap shadow-lg shadow-purple-500/20 flex items-center justify-center shrink-0" title="{{ __('Shorten') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14.121 14.121L19 19m-7-7l7-7m-7 7l-2.879 2.879M12 12L9.121 9.121m0 5.758a3 3 0 10-4.243 4.243 3 3 0 004.243-4.243zm0-9.141a3 3 0 10-4.243-4.243 3 3 0 004.243 4.243z" />
                        </svg>
                    </button>

                </div>

                @if ($errors->all())
                <div class="mt-4 flex items-center justify-center gap-2">
                    <svg class="w-5 h-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <p class="text-sm text-red-600 dark:text-red-400 font-medium">{{ $errors->first() }}</p>
                </div>
                @endif

                <!-- Human Verification -->
                <div class="mt-6 flex flex-col items-center gap-2" x-show="showCaptcha" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 -translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
                    <div class="h-captcha" data-sitekey="{{ Cache::get('platform.hcaptcha_sitekey', env('HCAPTCHA_SITEKEY')) }}" data-theme="dark" data-size="normal"></div>
                    <p x-show="captchaError" x-text="captchaError" class="text-red-500 text-xs font-semibold" x-cloak></p>
                </div>

                @if ($errors->any())
                <div class="mt-4 text-center">
                    @foreach ($errors->all() as $error)
                    @if($error != $errors->first('h-captcha-response'))
                    <p class="text-red-500 text-xs font-semibold">{{ $error }}</p>
                    @endif
                    @endforeach
                </div>
                @endif
            </form>

            <p class="text-lg md:text-xl text-gray-500 dark:text-gray-400 mb-12 max-w-2xl mx-auto leading-relaxed">
                {{ __('hero.description', ['appName' => Cache::get('platform.app_name', 'ScrollWebLink')]) }}
            </p>




            @if (session('guest_link'))
            <div class="mt-8 p-5 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-2xl max-w-lg mx-auto flex items-center justify-between shadow-sm">
                <div>
                    <p class="text-xs text-green-600 dark:text-green-400 font-bold uppercase tracking-wider mb-1">{{ __('Success!') }}</p>
                    <a href="{{ session('guest_link') }}" target="_blank" class="text-lg font-bold text-gray-900 dark:text-white hover:underline">{{ str_replace(['http://', 'https://'], '', session('guest_link')) }}</a>
                </div>
                <button onclick="navigator.clipboard.writeText('{{ session('guest_link') }}'); alert('{{ __('Copied!') }}');" class="p-2.5 bg-white dark:bg-[#121217] rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800 transition-all active:scale-95">
                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2-2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"></path>
                    </svg>
                </button>
            </div>
            @endif

        </div>

        {{-- Top Ad Banner --}}
        @if(Cache::has('platform.ads_top_banner') && Cache::get('platform.ads_top_banner'))
        <div class="w-full max-w-5xl mx-auto px-4 py-6">
            <div class="text-center">
                <span class="text-[10px] font-bold uppercase tracking-widest text-gray-400 dark:text-gray-600 mb-2 block">Advertisement</span>
                {!! Cache::get('platform.ads_top_banner') !!}
            </div>
        </div>
        @endif

        <!-- How It Works Section -->
        <section id="how-it-works" class="py-24 max-w-7xl mx-auto px-4 w-full" style="margin-top: 5rem;">
            <div class="text-center mb-5">
                <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 dark:text-white mb-4">{{ __('How It Works') }}</h2>
                <p class="text-gray-500 dark:text-gray-400">{{ __('Simple steps to powerful link management') }}</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 mb-4">
                <div class="flex flex-col items-center text-center p-8 bg-white dark:bg-[#121217] rounded-3xl border border-gray-100 dark:border-gray-800 shadow-sm hover:shadow-xl transition-all group">
                    <div class="w-16 h-16 rounded-2xl bg-purple-100 dark:bg-purple-900/30 text-purple-600 dark:text-purple-400 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3">1. {{ __('Shorten') }}</h3>
                    <p class="text-gray-500 text-sm">{{ __('how.shorten_desc') }}</p>
                </div>
                <div class="flex flex-col items-center text-center p-8 bg-white dark:bg-[#121217] rounded-3xl border border-gray-100 dark:border-gray-800 shadow-sm hover:shadow-xl transition-all group">
                    <div class="w-16 h-16 rounded-2xl bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3">2. {{ __('Share') }}</h3>
                    <p class="text-gray-500 text-sm">{{ __('how.share_desc') }}</p>
                </div>
                <div class="flex flex-col items-center text-center p-8 bg-white dark:bg-[#121217] rounded-3xl border border-gray-100 dark:border-gray-800 shadow-sm hover:shadow-xl transition-all group">
                    <div class="w-16 h-16 rounded-2xl bg-green-100 dark:bg-green-900/30 text-green-600 dark:text-green-400 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3">3. {{ __('Track') }}</h3>
                    <p class="text-gray-500 text-sm">{{ __('how.track_desc') }}</p>
                </div>
            </div>
        </section>

        {{-- Middle Ad Banner --}}
        @if(Cache::has('platform.ads_mid_banner') && Cache::get('platform.ads_mid_banner'))
        <div class="w-full max-w-5xl mx-auto px-4 py-6">
            <div class="text-center">
                <span class="text-[10px] font-bold uppercase tracking-widest text-gray-400 dark:text-gray-600 mb-2 block">Advertisement</span>
                {!! Cache::get('platform.ads_mid_banner') !!}
            </div>
        </div>
        @endif

        <!-- Pricing Section -->
        <section id="pricing" class="py-24 bg-gray-50/50 mx-auto px-4  w-full" style="margin-top: 5rem;">
            <div class="max-w-5xl mx-auto px-4">
                <div class="text-center mb-6">
                    <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 dark:text-white mb-4">{{ __('Choose Your Plan') }}</h2>
                    <p class="text-gray-500 dark:text-gray-400">{{ __('Scalable plans for every kind of creator') }}</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Free Plan -->
                    <div class="bg-white dark:bg-[#121217] rounded-[32px] p-5 border border-gray-100 dark:border-gray-800 shadow-sm relative overflow-hidden group">
                        <div class="mb-8">
                            <h3 class="text-xl font-bold mb-2">{{ __('Basic') }}</h3>
                            <div class="flex items-baseline gap-1">
                                <span class="text-4xl font-extrabold">$0</span>
                                <span class="text-gray-500">/{{ __('forever') }}</span>
                            </div>
                        </div>
                        <ul class="space-y-4 mb-10">
                            <li class="flex items-center gap-3 text-sm text-gray-600 dark:text-gray-400">
                                <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                100 {{ __('Short Links / month') }}
                            </li>
                            <li class="flex items-center gap-3 text-sm text-gray-600 dark:text-gray-400">
                                <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                {{ __('Basic Analytics (7 days)') }}
                            </li>
                            <li class="flex items-center gap-3 text-sm text-gray-600 dark:text-gray-400">
                                <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                {{ __('Regular Redirects') }}
                            </li>
                        </ul>
                        <a href="{{ route('register') }}" class="block text-center py-4 px-8 rounded-2xl bg-gray-100 dark:bg-gray-800 font-bold hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors">{{ __('Start for Free') }}</a>
                    </div>
                    <!-- Pro Plan -->
                    <div class="bg-white dark:bg-[#121217] rounded-[32px] p-5  shadow-2xl shadow-purple-500/10 relative overflow-hidden group">
                        <div class="absolute top-0 right-0 bg-purple-500 text-white text-[10px] uppercase font-bold px-4 py-1.5 rounded-bl-2xl">{{ __('Recommended') }}</div>
                        <div class="mb-8">
                            <h3 class="text-xl font-bold mb-2">{{ __('Pro') }}</h3>
                            <div class="flex items-baseline gap-1">
                                <span class="text-4xl font-extrabold">$19</span>
                                <span class="text-gray-500">/{{ __('month') }}</span>
                            </div>
                        </div>
                        <ul class="space-y-4 mb-10">
                            <li class="flex items-center gap-3 text-sm text-gray-600 dark:text-gray-400">
                                <svg class="w-5 h-5 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                {{ __('Unlimited Short Links') }}
                            </li>
                            <li class="flex items-center gap-3 text-sm text-gray-600 dark:text-gray-400">
                                <svg class="w-5 h-5 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                {{ __('Advanced Analytics (Real-time)') }}
                            </li>
                            <li class="flex items-center gap-3 text-sm text-gray-600 dark:text-gray-400">
                                <svg class="w-5 h-5 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                {{ __('API Access & Custom Slugs') }}
                            </li>
                            <li class="flex items-center gap-3 text-sm text-gray-600 dark:text-gray-400">
                                <svg class="w-5 h-5 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                {{ __('No Redirect Ads') }}
                            </li>
                        </ul>
                        <a href="{{ route('register') }}" class="block text-center py-4 px-8 rounded-2xl bg-gradient-to-r from-purple-500 to-indigo-600 text-white font-bold hover:scale-105 transition-transform shadow-lg shadow-purple-500/25">{{ __('Upgrade to Pro') }}</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- API Section -->
        <section id="api" class="py-24 max-w-7xl mx-auto px-4 w-full mt-5" style="margin-top: 5rem;">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div>
                    <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 dark:text-white mb-6">{{ __('Built for Developers') }}</h2>
                    <p class="text-gray-500 dark:text-gray-400 mb-8 leading-relaxed">{{ __('Integrate our powerful link shortening engine directly into your workflow.') }}</p>
                    <div class="space-y-4">
                        <div class="flex items-start gap-4">
                            <div class="p-2 rounded-lg bg-green-100 dark:bg-green-900/30 text-green-600"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg></div>
                            <div>
                                <h4 class="font-bold">{{ __('RESTful Design') }}</h4>
                                <p class="text-sm text-gray-500">{{ __('Standard JSON responses and clear error codes.') }}</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="p-2 rounded-lg bg-blue-100 dark:bg-blue-900/30 text-blue-600"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg></div>
                            <div>
                                <h4 class="font-bold">{{ __('Lightning Fast') }}</h4>
                                <p class="text-sm text-gray-500">{{ __('Global edge network for minimal latency.') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-[#0B0B0E] rounded-[32px] p-1 border border-gray-800 shadow-2xl">
                    <div class="bg-[#1A1A22] rounded-[30px] p-8 font-mono text-sm overflow-hidden">
                        <div class="flex gap-2 mb-6">
                            <div class="w-3 h-3 rounded-full bg-red-500/20 border border-red-500/50"></div>
                            <div class="w-3 h-3 rounded-full bg-yellow-500/20 border border-yellow-500/50"></div>
                            <div class="w-3 h-3 rounded-full bg-green-500/20 border border-green-500/50"></div>
                        </div>
                        <div class="space-y-1">
                            <p class="text-gray-500"># {{ __('api.comment_shorten') }}</p>
                            <p><span class="text-purple-400">curl</span> -X POST <span class="text-green-400">"{{ config('app.url') }}/api/shorten"</span> \</p>
                            <p> -H <span class="text-green-400">"Authorization: Bearer YOUR_TOKEN"</span> \</p>
                            <p> -H <span class="text-green-400">"Content-Type: application/json"</span> \</p>
                            <p> -d <span class="text-yellow-400">'{"original_url": "https://google.com"}'</span></p>
                            <div class="pt-6">
                                <p class="text-gray-500 border-t border-gray-800 pt-6"># {{ __('api.comment_response') }}</p>
                                <p class="text-purple-300">{</p>
                                <p> <span class="text-blue-400">"short_url"</span>: <span class="text-green-400">"{{ config('app.url') }}/XyZ123"</span>,</p>
                                <p> <span class="text-blue-400">"original_url"</span>: <span class="text-green-400">"https://google.com"</span></p>
                                <p class="text-purple-300">}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Bottom Ad Banner --}}
        @if(Cache::has('platform.ads_bottom_banner') && Cache::get('platform.ads_bottom_banner'))
        <div class="w-full max-w-5xl mx-auto px-4 py-6">
            <div class="text-center">
                <span class="text-[10px] font-bold uppercase tracking-widest text-gray-400 dark:text-gray-600 mb-2 block">Advertisement</span>
                {!! Cache::get('platform.ads_bottom_banner') !!}
            </div>
        </div>
        @endif

    </main>

    <script>
        function validateCaptcha() {
            const response = hcaptcha.getResponse();
            const form = document.querySelector('[x-data]');
            if (response.length === 0) {
                if (form && form.__x) {
                    form.__x.$data.captchaError = "{{ __('Please complete the captcha verification.') }}";
                }
                return false;
            }
            return true;
        }

    </script>

    <footer class="w-full py-12 text-center text-sm text-gray-500 dark:text-gray-400 relative z-20">
        {{ Cache::get('platform.footer_text', __('By. Asep Surya Somantri')) }}
    </footer>


</body>
</html>
