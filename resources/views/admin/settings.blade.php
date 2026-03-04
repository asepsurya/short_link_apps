<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold text-gray-900 dark:text-white mt-1">Application Settings</h2>
    </x-slot>

    <div class="">
        <div class=" mx-auto ">
            <div class="bg-white dark:bg-[#121217] rounded-2xl border border-gray-100 dark:border-gray-800 shadow-sm overflow-hidden p-8">
                
                <div class="flex items-center gap-4 mb-8">
                    <div class="w-12 h-12 rounded-2xl bg-purple-100 dark:bg-purple-900/40 flex items-center justify-center text-purple-600 dark:text-purple-400">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Customize Application</h1>
                        <p class="text-gray-500 dark:text-gray-400">Personalize your short link platform's branding and metadata.</p>
                    </div>
                </div>

                @if(session('success'))
                <div class="mb-6 bg-green-50 dark:bg-green-900/20 border border-green-100 dark:border-green-800 text-green-700 dark:text-green-400 px-4 py-3 rounded-xl flex items-center gap-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span class="text-sm font-medium">{{ session('success') }}</span>
                </div>
                @endif

                <form action="{{ route('admin.settings.update-app') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PATCH')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-start">
                        <!-- Branding Column -->
                        <div class="space-y-6">
                            <h3 class="text-sm font-bold text-gray-400 uppercase tracking-widest">Visual Branding</h3>
                            
                            <!-- Logo Upload -->
                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Application Logo</label>
                                <div class="flex items-center gap-6 p-4 bg-gray-50 dark:bg-[#1A1A22] rounded-2xl border border-dashed border-gray-200 dark:border-gray-700">
                                    <div class="w-16 h-16 rounded-xl bg-white dark:bg-[#121217] border border-gray-100 dark:border-gray-800 flex items-center justify-center overflow-hidden">
                                        @if(Cache::has('platform.logo_path'))
                                            <img src="{{ asset('storage/' . Cache::get('platform.logo_path')) }}" class="w-full h-full object-contain p-1">
                                        @else
                                            <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        @endif
                                    </div>
                                    <div class="flex-1">
                                        <input type="file" name="app_logo" id="app_logo" class="hidden" accept="image/*" onchange="this.nextElementSibling.innerText = this.files[0].name; document.getElementById('reset_logo_flag').value = 0;">
                                        <label for="app_logo" class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-lg font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none transition ease-in-out duration-150 cursor-pointer">
                                            Choose Logo
                                        </label>
                                        <input type="hidden" name="reset_logo" id="reset_logo_flag" value="0">
                                        @if(Cache::has('platform.logo_path'))
                                            <button type="button" onclick="document.getElementById('reset_logo_flag').value = 1; this.closest('form').submit();" class="block mt-2 text-[10px] text-red-500 hover:text-red-600 font-bold uppercase tracking-wider transition-colors">
                                                Reset to Default
                                            </button>
                                        @endif
                                        <span class="block mt-1 text-[10px] text-gray-500">JPG, PNG, SVG (Max 2MB)</span>
                                    </div>
                                </div>
                            </div>

                            <!-- App Name -->
                            <div>
                                <label for="app_name" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Application Name</label>
                                <input type="text" name="app_name" id="app_name" value="{{ Cache::get('platform.app_name', config('app.name')) }}" class="block w-full border-gray-200 dark:border-gray-700 dark:bg-[#1A1A22] dark:text-white focus:border-purple-500 focus:ring-purple-500 rounded-xl py-2.5 px-4 text-sm transition-colors shadow-sm">
                            </div>

                            <!-- Brand Color -->
                            <div>
                                <label for="primary_color" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Brand Accent Color</label>
                                <div class="flex items-center gap-3">
                                    <input type="color" name="primary_color" id="primary_color" value="{{ Cache::get('platform.primary_color', '#7c3aed') }}" class="w-12 h-12 rounded-xl border-gray-200 dark:border-gray-700 p-1 bg-white dark:bg-[#1A1A22] cursor-pointer">
                                    <span class="text-xs text-gray-500 dark:text-gray-400">Main theme highlight.</span>
                                </div>
                            </div>
                        </div>

                        <!-- Integration Column -->
                        <div class="space-y-6">
                            <h3 class="text-sm font-bold text-gray-400 uppercase tracking-widest">External Scripts</h3>

                            <!-- Analytics -->
                            <div>
                                <label for="analytics_script" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Google Analytics Code</label>
                                <textarea name="analytics_script" id="analytics_script" rows="4" class="block w-full font-mono text-xs border-gray-200 dark:border-gray-700 dark:bg-[#1A1A22] dark:text-white focus:border-purple-500 focus:ring-purple-500 rounded-xl py-2.5 px-4 transition-colors shadow-sm" placeholder="<script async src='https://www.googletagmanager.com/gtag/js?id=G-XXXX'></script>...">{{ Cache::get('platform.analytics_script') }}</textarea>
                            </div>

                            <!-- AdSense -->
                            <div>
                                <label for="adsense_script" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Google AdSense Code</label>
                                <textarea name="adsense_script" id="adsense_script" rows="4" class="block w-full font-mono text-xs border-gray-200 dark:border-gray-700 dark:bg-[#1A1A22] dark:text-white focus:border-purple-500 focus:ring-purple-500 rounded-xl py-2.5 px-4 transition-colors shadow-sm" placeholder="<script async src='https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-XXXX'></script>...">{{ Cache::get('platform.adsense_script') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- SEO Settings Section -->
                    <div class="pt-6 border-t border-gray-100 dark:border-gray-800">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">SEO & Metadata</h3>
                        <div class="grid grid-cols-1 gap-6">
                            <!-- Meta Title -->
                            <div>
                                <label for="meta_title" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Default Meta Title</label>
                                <input type="text" name="meta_title" id="meta_title" value="{{ Cache::get('platform.meta_title', 'ScrollWebLink - High Performance URL Shortener') }}" class="block w-full border-gray-200 dark:border-gray-700 dark:bg-[#1A1A22] dark:text-white focus:border-purple-500 focus:ring-purple-500 rounded-xl py-2.5 px-4 text-sm transition-colors shadow-sm">
                            </div>

                            <!-- Meta Description -->
                            <div>
                                <label for="meta_description" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Default Meta Description</label>
                                <textarea name="meta_description" id="meta_description" rows="3" class="block w-full border-gray-200 dark:border-gray-700 dark:bg-[#1A1A22] dark:text-white focus:border-purple-500 focus:ring-purple-500 rounded-xl py-2.5 px-4 text-sm transition-colors shadow-sm">{{ Cache::get('platform.meta_description', 'Shorten URLs, track clicks, and manage high-performing links with our powerful platform.') }}</textarea>
                            </div>

                            <!-- Meta Keywords -->
                            <div>
                                <label for="meta_keywords" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Default Meta Keywords</label>
                                <input type="text" name="meta_keywords" id="meta_keywords" value="{{ Cache::get('platform.meta_keywords', 'url shortener, link tracker, analytics, leads') }}" class="block w-full border-gray-200 dark:border-gray-700 dark:bg-[#1A1A22] dark:text-white focus:border-purple-500 focus:ring-purple-500 rounded-xl py-2.5 px-4 text-sm transition-colors shadow-sm">
                            </div>
                        </div>
                    </div>

                    <!-- General configuration -->
                    <div class="pt-6 border-t border-gray-100 dark:border-gray-800">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">General Configuration</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Redirect Duration -->
                            <div>
                                <label for="redirect_duration" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Redirect Duration (Seconds)</label>
                                <input type="number" name="redirect_duration" id="redirect_duration" value="{{ Cache::get('platform.redirect_duration', 10) }}" class="block w-full border-gray-200 dark:border-gray-700 dark:bg-[#1A1A22] dark:text-white focus:border-purple-500 focus:ring-purple-500 rounded-xl py-2.5 px-4 text-sm transition-colors shadow-sm">
                                <p class="mt-1.5 text-xs text-gray-500 dark:text-gray-400">Time users wait on the countdown page.</p>
                            </div>

                            <!-- Footer Text -->
                            <div>
                                <label for="footer_text" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Footer Copyright Text</label>
                                <input type="text" name="footer_text" id="footer_text" value="{{ Cache::get('platform.footer_text', '© ' . date('Y') . ' ShortWebLink. All rights reserved.') }}" class="block w-full border-gray-200 dark:border-gray-700 dark:bg-[#1A1A22] dark:text-white focus:border-purple-500 focus:ring-purple-500 rounded-xl py-2.5 px-4 text-sm transition-colors shadow-sm" placeholder="e.g. © 2024 YourCompany">
                            </div>
                        </div>
                    </div>

                    <div class="pt-4 border-t border-gray-100 dark:border-gray-800 flex justify-end">
                        <button type="submit" class="inline-flex items-center gap-2 py-3 px-8 rounded-xl bg-purple-600 text-white text-sm font-bold hover:bg-purple-700 transition-all shadow-md active:scale-95">
                            Save Application Configuration
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
