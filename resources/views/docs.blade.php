<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ __('docs.page_title') }} | {{ Cache::get('platform.meta_title', config('app.name', 'ScrollWebLink')) }}</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        [x-cloak] { display: none !important; }

        /* Google Cloud Style Background/Layout */
        body {
            background-color: #FAFAFA;
        }
        .dark body {
            background-color: #0B0B0E;
        }

        /* Documentation Container Card */
        .doc-main-card {
            background: #FFFFFF;
            border: 1px solid #EDEDED;
            box-shadow: 0 1px 2px rgba(0,0,0,0.05);
        }
        .dark .doc-main-card {
            background: #121217;
            border: 1px solid rgba(255, 255, 255, 0.05);
            box-shadow: 0 20px 40px -20px rgba(0, 0, 0, 0.5);
        }

        /* Sidebar Styling */
        .doc-sidebar-nav::-webkit-scrollbar {
            width: 4px;
        }
        .doc-sidebar-nav::-webkit-scrollbar-thumb {
            background: rgba(124, 58, 237, 0.1);
            border-radius: 10px;
        }

        .doc-sidebar-link {
            position: relative;
            transition: all 0.2s ease;
            color: #3C4043;
        }
        .dark .doc-sidebar-link {
            color: #9AA0A6;
        }

        .doc-sidebar-active {
            color: #1A73E8 !important; /* Google Blue */
            background: rgba(26, 115, 232, 0.04);
            font-weight: 500;
        }
        .dark .doc-sidebar-active {
            color: #8AB4F8 !important; 
            background: rgba(138, 180, 248, 0.08);
        }

        .doc-sidebar-active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 4px;
            bottom: 4px;
            width: 4px;
            background: #1A73E8;
            border-radius: 0 4px 4px 0;
        }
        .dark .doc-sidebar-active::before {
            background: #8AB4F8;
        }

        /* ToC Active State */
        .toc-link-active {
            color: #1A73E8 !important;
            border-left-color: #1A73E8 !important;
        }
        .dark .toc-link-active {
            color: #8AB4F8 !important;
            border-left-color: #8AB4F8 !important;
        }

        /* Banners */
        .doc-banner { border-left-width: 4px; }
        .doc-banner-tip { background: #F0FDF4; border-color: #22C55E; color: #166534; }
        .dark .doc-banner-tip { background: rgba(34, 197, 94, 0.05); border-color: #22C55E; color: #4ADE80; }
        .doc-banner-info { background: #E8F0FE; border-color: #1A73E8; color: #174EA6; }
        .dark .doc-banner-info { background: rgba(26, 115, 232, 0.05); border-color: #1A73E8; color: #8AB4F8; }
        .doc-banner-warning { background: #FEF7E0; border-color: #F9AB00; color: #3C4043; }
        .dark .doc-banner-warning { background: rgba(249, 171, 0, 0.05); border-color: #F9AB00; color: #FBBF24; }
    </style>
</head>
<body 
    class="font-sans antialiased selection:bg-blue-100 selection:text-blue-900 min-h-screen text-gray-900 dark:text-gray-300"
    x-data="{
        activeSection: 'intro',
        sidebarFilter: '',
        openSections: {
            general: true,
            dashboard: true,
            api: true
        },
        handleScroll() {
            const sections = ['intro', 'dark-mode', 'guest-mode', 'advanced-features', 'analytics', 'api-token', 'api-reference'];
            const scrollPosition = window.scrollY + 100;

            for (const sectionId of sections) {
                const element = document.getElementById(sectionId);
                if (element && scrollPosition >= element.offsetTop && scrollPosition < (element.offsetTop + element.offsetHeight)) {
                    this.activeSection = sectionId;
                    break;
                }
            }
        },
        shouldShow(label) {
            if (!this.sidebarFilter) return true;
            return label.toLowerCase().includes(this.sidebarFilter.toLowerCase());
        }
    }"
    x-init="window.addEventListener('scroll', () => handleScroll());"
>
    
    <!-- Top Navbar -->
    <nav class="fixed w-full z-50 border-b border-gray-200 dark:border-gray-800 bg-white dark:bg-[#0B0B0E] h-16">
        <div class="px-4 sm:px-6 lg:px-8 h-full">
            <div class="flex justify-between items-center h-full">
                <div class="flex items-center gap-4 lg:gap-8">
                    <button class="lg:hidden p-2 text-gray-500 hover:bg-gray-100 dark:hover:bg-white/5 rounded-lg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    </button>
                    <a href="/" class="flex items-center gap-2">
                        <div class="w-8 h-8 bg-blue-600 rounded flex items-center justify-center text-white font-bold text-xl">S</div>
                        <span class="text-xl font-medium tracking-tight dark:text-gray-100">Docs</span>
                    </a>
                </div>

                <div class="flex items-center gap-4 uppercase font-bold text-[11px] tracking-widest text-gray-500">
                    <a href="{{ route('lang.switch', 'id') }}" class="hover:text-blue-600 {{ App::getLocale() == 'id' ? 'text-blue-600' : '' }}">ID</a>
                    <span class="text-gray-300 dark:text-gray-700">|</span>
                    <a href="{{ route('lang.switch', 'en') }}" class="hover:text-blue-600 {{ App::getLocale() == 'en' ? 'text-blue-600' : '' }}">EN</a>
                    <a href="/" class="ml-4 px-4 py-2 border border-gray-200 dark:border-gray-700 rounded-md hover:bg-gray-50 dark:hover:bg-white/5 transition-colors">{{ __('Back to Home') }}</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="flex pt-5 min-h-screen">
        
        <!-- Sidebar Navigation (Left Column) -->
        <aside class="hidden lg:block w-72 border-r border-gray-200 dark:border-gray-800 flex-shrink-0 bg-white dark:bg-[#0B0B0E] sticky top-16 h-[calc(100vh-64px)] overflow-y-auto doc-sidebar-nav">
            <div class="p-6">
                <!-- Filter -->
                <div class="mb-8">
                    <div class="relative group">
                        <input 
                            type="text" 
                            x-model="sidebarFilter"
                            placeholder="Filter" 
                            class="w-full bg-gray-50 dark:bg-white/5 border border-gray-200 dark:border-white/10 rounded px-4 py-2 text-sm focus:outline-none focus:border-blue-500 transition-all placeholder:text-gray-400"
                        >
                        <div class="absolute right-3 top-2.5">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </div>
                    </div>
                </div>

                <!-- Nav Groups -->
                <div class="space-y-6">
                    <!-- General -->
                    <div x-show="shouldShow('{{ __('docs.nav_general') }}') || shouldShow('{{ __('docs.nav_intro') }}') || shouldShow('{{ __('docs.nav_dark_mode') }}') || shouldShow('{{ __('docs.nav_guest') }}')">
                        <h3 class="px-4 text-[11px] font-black text-gray-400 dark:text-gray-600 uppercase tracking-widest mb-2">{{ __('docs.nav_general') }}</h3>
                        <div class="space-y-0.5">
                            <a href="#intro" x-show="shouldShow('{{ __('docs.nav_intro') }}')" @click="activeSection = 'intro'" :class="activeSection === 'intro' ? 'doc-sidebar-active' : ''" class="flex items-center px-4 py-2 text-[13px] doc-sidebar-link rounded-r-full">{{ __('docs.nav_intro') }}</a>
                            <a href="#dark-mode" x-show="shouldShow('{{ __('docs.nav_dark_mode') }}')" @click="activeSection = 'dark-mode'" :class="activeSection === 'dark-mode' ? 'doc-sidebar-active' : ''" class="flex items-center px-4 py-2 text-[13px] doc-sidebar-link rounded-r-full">{{ __('docs.nav_dark_mode') }}</a>
                            <a href="#guest-mode" x-show="shouldShow('{{ __('docs.nav_guest') }}')" @click="activeSection = 'guest-mode'" :class="activeSection === 'guest-mode' ? 'doc-sidebar-active' : ''" class="flex items-center px-4 py-2 text-[13px] doc-sidebar-link rounded-r-full">{{ __('docs.nav_guest') }}</a>
                        </div>
                    </div>

                    <!-- Dashboard -->
                    <div x-show="shouldShow('{{ __('docs.nav_dashboard') }}') || shouldShow('{{ __('docs.nav_advanced') }}') || shouldShow('{{ __('docs.nav_analytics') }}')">
                        <h3 class="px-4 text-[11px] font-black text-gray-400 dark:text-gray-600 uppercase tracking-widest mb-2">{{ __('docs.nav_dashboard') }}</h3>
                        <div class="space-y-0.5">
                            <a href="#advanced-features" x-show="shouldShow('{{ __('docs.nav_advanced') }}')" @click="activeSection = 'advanced-features'" :class="activeSection === 'advanced-features' ? 'doc-sidebar-active' : ''" class="flex items-center px-4 py-2 text-[13px] doc-sidebar-link rounded-r-full">{{ __('docs.nav_advanced') }}</a>
                            <a href="#analytics" x-show="shouldShow('{{ __('docs.nav_analytics') }}')" @click="activeSection = 'analytics'" :class="activeSection === 'analytics' ? 'doc-sidebar-active' : ''" class="flex items-center px-4 py-2 text-[13px] doc-sidebar-link rounded-r-full">{{ __('docs.nav_analytics') }}</a>
                        </div>
                    </div>

                    <!-- API -->
                    <div x-show="shouldShow('{{ __('docs.nav_api') }}') || shouldShow('{{ __('docs.nav_generate_token') }}') || shouldShow('{{ __('docs.nav_endpoints') }}')">
                        <h3 class="px-4 text-[11px] font-black text-gray-400 dark:text-gray-600 uppercase tracking-widest mb-2">{{ __('docs.nav_api') }}</h3>
                        <div class="space-y-0.5">
                            <a href="#api-token" x-show="shouldShow('{{ __('docs.nav_generate_token') }}')" @click="activeSection = 'api-token'" :class="activeSection === 'api-token' ? 'doc-sidebar-active' : ''" class="flex items-center px-4 py-2 text-[13px] doc-sidebar-link rounded-r-full">{{ __('docs.nav_generate_token') }}</a>
                            <a href="#api-reference" x-show="shouldShow('{{ __('docs.nav_endpoints') }}')" @click="activeSection = 'api-reference'" :class="activeSection === 'api-reference' ? 'doc-sidebar-active' : ''" class="flex items-center px-4 py-2 text-[13px] doc-sidebar-link rounded-r-full">{{ __('docs.nav_endpoints') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Main Content (Center Column) -->
        <main class="flex-1 min-w-0 bg-[#FAFAFA] dark:bg-[#0B0B0E] p-4 lg:p-12 overflow-y-auto">
            <div class="max-w-4xl mx-auto">
                
                <nav class="flex items-center gap-2 text-xs text-gray-500 mb-8 font-medium">
                    <a href="/" class="hover:text-blue-600">Home</a>
                    <span>/</span>
                    <a href="/docs" class="hover:text-blue-600">Documentation</a>
                    <span>/</span>
                    <span class="text-gray-900 dark:text-gray-100 font-bold" x-text="activeSection.replace('-', ' ').toUpperCase()"></span>
                </nav>

                <div class="doc-main-card rounded-xl p-8 lg:p-12 mb-20">
                    <!-- Introduction -->
                    <section id="intro" class="mb-20 scroll-mt-32">
                        <h1 class="text-4xl lg:text-5xl font-bold tracking-tight mb-6 dark:text-white">{{ __('docs.intro_title') }}</h1>
                        <p class="text-lg text-gray-600 dark:text-gray-400 mb-10 leading-relaxed">{{ __('docs.intro_desc') }}</p>
                        
                        <div class="doc-banner doc-banner-info p-6 rounded-lg flex gap-4 mb-10 shadow-sm border border-blue-500/20">
                            <div class="mt-1">
                                <svg class="w-6 h-6 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                            </div>
                            <div>
                                <h4 class="font-bold mb-1">Welcome to the Platform</h4>
                                <p class="text-sm opacity-90 leading-relaxed">{{ __('docs.discover_note', ['app' => config('app.name')]) }}</p>
                            </div>
                        </div>

                        <div class="grid md:grid-cols-2 gap-8">
                            <div class="p-6 border border-gray-100 dark:border-white/5 rounded-xl hover:shadow-md transition-shadow">
                                <h3 class="font-bold mb-3 dark:text-white">{{ __('docs.why_choose_us') }}</h3>
                                <p class="text-sm text-gray-500 dark:text-gray-400 leading-relaxed">{{ __('docs.why_choose_us_desc') }}</p>
                            </div>
                            <div class="p-6 border border-gray-100 dark:border-white/5 rounded-xl hover:shadow-md transition-shadow">
                                <h3 class="font-bold mb-3 dark:text-white">{{ __('docs.global_reach') }}</h3>
                                <p class="text-sm text-gray-500 dark:text-gray-400 leading-relaxed">{{ __('docs.global_reach_desc') }}</p>
                            </div>
                        </div>
                    </section>

                    <!-- Dark Mode Section -->
                    <section id="dark-mode" class="mb-24 scroll-mt-32 border-t border-gray-100 dark:border-white/5 pt-5">
                        <h2 class="text-3xl font-bold mb-8 dark:text-white">{{ __('docs.dark_mode_title') }}</h2>
                        <div class="space-y-6">
                            <p class="text-gray-600 dark:text-gray-400 leading-relaxed">{{ __('docs.dark_mode_desc') }}</p>
                            <div class="p-8 bg-gray-50 dark:bg-white/5 rounded-xl border border-gray-100 dark:border-white/5">
                                <ul class="space-y-4">
                                    @for ($i = 1; $i <= 3; $i++)
                                    <li class="flex items-start gap-3">
                                        <div class="mt-1 text-blue-600"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg></div>
                                        <span class="text-[13px]">{{ __('docs.dark_mode_feature_' . $i) }}</span>
                                    </li>
                                    @endfor
                                </ul>
                            </div>
                        </div>
                    </section>

                    <!-- Guest Mode Section -->
                    <section id="guest-mode" class="mb-24 scroll-mt-32 border-t border-gray-100 dark:border-white/5 pt-5">
                        <h2 class="text-3xl font-bold mb-8 dark:text-white">{{ __('docs.guest_mode_title') }}</h2>
                        <div class="grid md:grid-cols-3 gap-10">
                            @for ($i = 1; $i <= 3; $i++)
                            <div>
                                <div class="text-[11px] font-black text-blue-600 uppercase mb-3">Step 0{{ $i }}</div>
                                <h3 class="font-bold mb-2 dark:text-white">{{ __('docs.guest_step_' . $i) }}</h3>
                                <p class="text-sm text-gray-500 leading-relaxed">{{ __('docs.guest_step_' . $i . '_desc') }}</p>
                            </div>
                            @endfor
                        </div>
                    </section>

                    <!-- API Token Section -->
                    <section id="api-token" class="mb-24 scroll-mt-32 border-t border-gray-100 dark:border-white/5 pt-5">
                        <h2 class="text-3xl font-bold mb-8 dark:text-white">{{ __('docs.token_gen_title') }}</h2>
                        <div class="space-y-8">
                            <p class="text-gray-600 dark:text-gray-400">{{ __('docs.token_gen_desc') }}</p>
                            <div class="p-1 border border-gray-200 dark:border-white/5 rounded-xl">
                                <table class="w-full text-sm text-left">
                                    <thead class="bg-gray-50 dark:bg-white/5 font-bold uppercase text-[10px] tracking-widest text-gray-400">
                                        <tr><th class="px-6 py-4">Step</th><th class="px-6 py-4">Action</th></tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-100 dark:divide-white/5">
                                        <tr><td class="px-6 py-4 font-black">01</td><td class="px-6 py-4">{{ __('docs.gen_step_1') }} <b>Profile</b></td></tr>
                                        <tr><td class="px-6 py-4 font-black">02</td><td class="px-6 py-4">{{ __('docs.gen_step_2') }} <b>API Tokens</b></td></tr>
                                        <tr><td class="px-6 py-4 font-black">03</td><td class="px-6 py-4">{{ __('docs.gen_step_3') }} <b>Generate</b></td></tr>
                                        <tr><td class="px-6 py-4 font-black">04</td><td class="px-6 py-4">{{ __('docs.gen_step_4') }}</td></tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="doc-banner doc-banner-warning p-5 rounded-lg flex gap-3 text-sm mt-5">
                                <div class="mt-0.5"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg></div>
                                <p><strong>{{ __('Warning') }}:</strong> {{ __('docs.token_warning') }}</p>
                            </div>
                        </div>
                    </section>

                    <!-- API Reference Section -->
                    <section id="api-reference" class="mb-10 scroll-mt-32 border-t border-gray-100 dark:border-white/5 pt-5">
                         <img src="{{ asset('image.png') }}" alt="" srcset="">
                         <img src="{{ asset('image_2.png') }}" alt="" srcset="">
                        <h2 class="text-3xl font-bold mb-4 dark:text-white">{{ __('docs.api_ref_title') }}</h2>
                        <p class="mb-12 text-gray-500">{{ __('docs.api_ref_desc') }}</p>
                       
                        <div class="space-y-16">
                            <!-- POST Create Link -->
                            <div class="space-y-6">
                                <div class="flex items-center gap-3">
                                    <span class="px-2 py-0.5 bg-emerald-100 text-emerald-700 dark:bg-emerald-900/40 dark:text-emerald-400 text-[10px] font-black rounded uppercase tracking-tighter">POST</span>
                                    <code class="text-[14px] font-bold text-gray-900 dark:text-gray-100">/api/v1/links</code>
                                </div>
                                <p class="text-[13px] text-gray-500 leading-relaxed">{{ __('docs.api_create_desc') }}</p>
                                <div class="bg-[#1A1C1E] rounded-lg p-6 overflow-x-auto shadow-xl">
                                    <pre class="text-[13px] text-gray-400 leading-relaxed"><code><span class="text-blue-400">curl</span> -X POST <span class="text-emerald-400">"{{ config('app.url') }}/api/v1/links"</span> \
  -H <span class="text-emerald-400">"Authorization: Bearer YOUR_TOKEN"</span> \
  -H <span class="text-emerald-400">"Content-Type: application/json"</span> \
  -d <span class="text-amber-300">'{
    "original_url": "https://example.com/very-long-url",
    "custom_slug": "my-brand",
    "password": "secret-password",
    "expires_at": "2026-12-31 23:59:59"
  }'</span></code></pre>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>

                <!-- Needs Help CTA -->
                <div class="mt-5 p-5 flex flex-col md:flex-row items-center justify-between p-10 bg-white dark:bg-[#121217] border border-gray-100 dark:border-white/5 rounded-xl mb-24">
                    <div class="mb-4 md:mb-0">
                        <h3 class="text-2xl font-bold dark:text-white mb-2">{{ __('docs.need_help') }}</h3>
                        <p class="text-gray-500 text-sm">{{ __('Contact our support team for any custom integration needs or questions.') }}</p>
                    </div>
                    <a href="mailto:support@{{ request()->getHost() }}" class="px-8 py-3 bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold rounded shadow-lg shadow-blue-600/20 transition-all">
                        {{ __('Contact Support') }}
                    </a>
                </div>
            </div>
        </main>

        <!-- On this Page (Right Column) -->
        <aside class="hidden xl:block w-64 flex-shrink-0 bg-white dark:bg-[#0B0B0E] p-8 sticky top-16 h-[calc(100vh-64px)] overflow-y-auto">
            <h4 class="text-[11px] font-black text-gray-400 dark:text-gray-600 uppercase tracking-widest mb-6">On this page</h4>
            <nav class="space-y-4 text-[13px] font-medium">
                <a href="#intro" :class="activeSection === 'intro' ? 'toc-link-active' : 'text-gray-500 border-transparent'" class="block border-l-2 pl-4 hover:text-blue-600 transition-all">{{ __('docs.nav_intro') }}</a>
                <a href="#dark-mode" :class="activeSection === 'dark-mode' ? 'toc-link-active' : 'text-gray-500 border-transparent'" class="block border-l-2 pl-4 hover:text-blue-600 transition-all">{{ __('docs.nav_dark_mode') }}</a>
                <a href="#guest-mode" :class="activeSection === 'guest-mode' ? 'toc-link-active' : 'text-gray-500 border-transparent'" class="block border-l-2 pl-4 hover:text-blue-600 transition-all">{{ __('docs.nav_guest') }}</a>
                <a href="#api-token" :class="activeSection === 'api-token' ? 'toc-link-active' : 'text-gray-500 border-transparent'" class="block border-l-2 pl-4 hover:text-blue-600 transition-all">{{ __('docs.nav_generate_token') }}</a>
                <a href="#api-reference" :class="activeSection === 'api-reference' ? 'toc-link-active' : 'text-gray-500 border-transparent'" class="block border-l-2 pl-4 hover:text-blue-600 transition-all">{{ __('docs.nav_endpoints') }}</a>
            </nav>
        </aside>
    </div>

</body>
</html>
