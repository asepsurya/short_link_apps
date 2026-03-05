<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold text-gray-900 dark:text-white mt-1">Application Settings</h2>
    </x-slot>

    <div x-data="{ activeTab: 'app' }">
        <!-- Full-width tab bar -->
        <div class="bg-gray-50/50 dark:bg-[#1A1A22]/50 border-b border-gray-200 dark:border-gray-800 mb-8 shadow-sm py-4">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Tab Navigation (Pill Style) -->
                <div class="flex overflow-x-auto gap-2 hide-scrollbar">
                    <button @click="activeTab = 'app'" :class="{'bg-purple-100 text-purple-700 dark:bg-purple-900/40 dark:text-purple-400 ring-1 ring-purple-200 dark:ring-purple-800': activeTab === 'app', 'bg-white dark:bg-[#121217] text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-800 border border-gray-200 dark:border-gray-800': activeTab !== 'app'}" class="flex-shrink-0 px-5 py-2.5 rounded-xl font-bold text-sm transition-all shadow-sm flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        General
                    </button>
                    <button @click="activeTab = 'database'" :class="{'bg-purple-100 text-purple-700 dark:bg-purple-900/40 dark:text-purple-400 ring-1 ring-purple-200 dark:ring-purple-800': activeTab === 'database', 'bg-white dark:bg-[#121217] text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-800 border border-gray-200 dark:border-gray-800': activeTab !== 'database'}" class="flex-shrink-0 px-5 py-2.5 rounded-xl font-bold text-sm transition-all shadow-sm flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"></path>
                        </svg>
                        Database
                    </button>
                    <button @click="activeTab = 'mail'" :class="{'bg-purple-100 text-purple-700 dark:bg-purple-900/40 dark:text-purple-400 ring-1 ring-purple-200 dark:ring-purple-800': activeTab === 'mail', 'bg-white dark:bg-[#121217] text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-800 border border-gray-200 dark:border-gray-800': activeTab !== 'mail'}" class="flex-shrink-0 px-5 py-2.5 rounded-xl font-bold text-sm transition-all shadow-sm flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        Mail (SMTP)
                    </button>
                    <button @click="activeTab = 'services'" :class="{'bg-purple-100 text-purple-700 dark:bg-purple-900/40 dark:text-purple-400 ring-1 ring-purple-200 dark:ring-purple-800': activeTab === 'services', 'bg-white dark:bg-[#121217] text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-800 border border-gray-200 dark:border-gray-800': activeTab !== 'services'}" class="flex-shrink-0 px-5 py-2.5 rounded-xl font-bold text-sm transition-all shadow-sm flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path>
                        </svg>
                        Services
                    </button>
                    <button @click="activeTab = 'advanced'" :class="{'bg-purple-100 text-purple-700 dark:bg-purple-900/40 dark:text-purple-400 ring-1 ring-purple-200 dark:ring-purple-800': activeTab === 'advanced', 'bg-white dark:bg-[#121217] text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-800 border border-gray-200 dark:border-gray-800': activeTab !== 'advanced'}" class="flex-shrink-0 px-5 py-2.5 rounded-xl font-bold text-sm transition-all shadow-sm flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path>
                        </svg>
                        Advanced / SEO
                    </button>
                    <button @click="activeTab = 'ads'" :class="{'bg-purple-100 text-purple-700 dark:bg-purple-900/40 dark:text-purple-400 ring-1 ring-purple-200 dark:ring-purple-800': activeTab === 'ads', 'bg-white dark:bg-[#121217] text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-800 border border-gray-200 dark:border-gray-800': activeTab !== 'ads'}" class="flex-shrink-0 px-5 py-2.5 rounded-xl font-bold text-sm transition-all shadow-sm flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path>
                        </svg>
                        Ads Banner
                    </button>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-[#121217] rounded-2xl border border-gray-100 dark:border-gray-800 shadow-sm overflow-hidden p-8 mb-8">

                @if(session('success'))
                <div class="mb-6 bg-green-50 dark:bg-green-900/20 border border-green-100 dark:border-green-800 text-green-700 dark:text-green-400 px-4 py-3 rounded-xl flex items-center gap-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span class="text-sm font-medium">{{ session('success') }}</span>
                </div>
                @endif
                @if ($errors->any())
                <div class="mb-6 bg-red-50 dark:bg-red-900/20 border border-red-100 dark:border-red-800 text-red-700 dark:text-red-400 px-4 py-3 rounded-xl">
                    <p class="font-bold flex items-center gap-2 mb-2">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        Please check the form below for errors:
                    </p>
                    <ul class="list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form action="{{ route('admin.settings.update-app') }}" method="POST" enctype="multipart/form-data" class="space-y-12">
                    @csrf
                    @method('PATCH')

                    <!-- TAB: GENERAL -->
                    <div x-show="activeTab === 'app'" x-cloak>
                        <div class="flex items-center gap-4 mb-6">
                            <div>
                                <h1 class="text-xl font-bold text-gray-900 dark:text-white">General Information</h1>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Core application settings and branding.</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-start">
                            <!-- Visual Branding -->
                            <div class="space-y-8">
                                <!-- App Name -->
                                <div class="mb-6">
                                    <label for="app_name" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Application Name</label>
                                    <input type="text" name="app_name" id="app_name" value="{{ old('app_name', env('APP_NAME')) }}" class="block w-full border-gray-200 dark:border-gray-700 dark:bg-[#1A1A22] dark:text-white focus:border-purple-500 focus:ring-purple-500 rounded-xl py-2.5 px-4 text-sm transition-colors shadow-sm">
                                </div>

                                <!-- App URL -->
                                <div class="mb-6">
                                    <label for="app_url" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Application URL</label>
                                    <input type="url" name="app_url" id="app_url" value="{{ old('app_url', env('APP_URL')) }}" class="block w-full border-gray-200 dark:border-gray-700 dark:bg-[#1A1A22] dark:text-white focus:border-purple-500 focus:ring-purple-500 rounded-xl py-2.5 px-4 text-sm transition-colors shadow-sm font-mono">
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <!-- App Environment -->
                                    <div class="mb-6">
                                        <label for="app_env" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Environment</label>
                                        <select name="app_env" id="app_env" class="block w-full border-gray-200 dark:border-gray-700 dark:bg-[#1A1A22] dark:text-white focus:border-purple-500 focus:ring-purple-500 rounded-xl py-2.5 px-4 text-sm transition-colors shadow-sm">
                                            <option value="local" {{ env('APP_ENV') === 'local' ? 'selected' : '' }}>Local</option>
                                            <option value="production" {{ env('APP_ENV') === 'production' ? 'selected' : '' }}>Production</option>
                                        </select>
                                    </div>

                                    <!-- App Debug -->
                                    <div class="mb-6">
                                        <label for="app_debug" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Debug Mode</label>
                                        <select name="app_debug" id="app_debug" class="block w-full border-gray-200 dark:border-gray-700 dark:bg-[#1A1A22] dark:text-white focus:border-purple-500 focus:ring-purple-500 rounded-xl py-2.5 px-4 text-sm transition-colors shadow-sm">
                                            <option value="1" {{ env('APP_DEBUG') == true ? 'selected' : '' }}>True (Enabled)</option>
                                            <option value="0" {{ env('APP_DEBUG') == false ? 'selected' : '' }}>False (Disabled)</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Brand Accent Color -->
                                <div class="mb-6">
                                    <label for="primary_color" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Brand Accent Color</label>
                                    <div class="flex items-center gap-3">
                                        <input type="color" name="primary_color" id="primary_color" value="{{ \App\Models\Setting::get('platform.primary_color', '#7c3aed') }}" class="w-12 h-12 rounded-xl border-gray-200 dark:border-gray-700 p-1 bg-white dark:bg-[#1A1A22] cursor-pointer">
                                        <span class="text-xs text-gray-500 dark:text-gray-400">Main theme highlight color.</span>
                                    </div>
                                </div>
                            </div>

                            <div class="space-y-8">
                                <!-- Logo Upload -->
                                <div class="mb-6 space-y-2">
                                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Application Logo</label>
                                    <div class="flex items-center gap-6 p-4 bg-gray-50 dark:bg-[#1A1A22] rounded-2xl border border-dashed border-gray-200 dark:border-gray-700">
                                        <div class="w-16 h-16 rounded-xl bg-white dark:bg-[#121217] border border-gray-100 dark:border-gray-800 flex items-center justify-center overflow-hidden">
                                            @if(\App\Models\Setting::has('platform.logo_path'))
                                            <img src="{{ asset('storage/' . \App\Models\Setting::get('platform.logo_path')) }}" class="w-full h-full object-contain p-1">
                                            @else
                                            <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                            @endif
                                        </div>
                                        <div class="flex-1">
                                            <input type="file" name="app_logo" id="app_logo" class="hidden" accept="image/*" onchange="this.nextElementSibling.innerText = this.files[0].name; document.getElementById('reset_logo_flag').value = 0;">
                                            <label for="app_logo" class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-lg font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none transition cursor-pointer">
                                                Choose Logo
                                            </label>
                                            <input type="hidden" name="reset_logo" id="reset_logo_flag" value="0">
                                            @if(\App\Models\Setting::has('platform.logo_path'))
                                            <button type="button" onclick="document.getElementById('reset_logo_flag').value = 1; this.closest('form').submit();" class="block mt-2 text-[10px] text-red-500 hover:text-red-600 font-bold uppercase tracking-wider transition-colors">
                                                Reset to Default
                                            </button>
                                            @endif
                                            <span class="block mt-1 text-[10px] text-gray-500">JPG, PNG, SVG (Max 2MB)</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Footer Text -->
                                <div class="mb-6">
                                    <label for="footer_text" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Footer Copyright Text</label>
                                    <input type="text" name="footer_text" id="footer_text" value="{{ \App\Models\Setting::get('platform.footer_text', '© ' . date('Y') . ' ShortWebLink. All rights reserved.') }}" class="block w-full border-gray-200 dark:border-gray-700 dark:bg-[#1A1A22] dark:text-white focus:border-purple-500 focus:ring-purple-500 rounded-xl py-2.5 px-4 text-sm transition-colors shadow-sm">
                                </div>

                                <!-- Public Link Creation Toggle -->
                                <div class="mt-6 p-5 rounded-xl border border-gray-200 dark:border-gray-800 bg-gray-50 dark:bg-[#1A1A22] flex items-center justify-between">
                                    <div class="mb-6">
                                        <h4 class="text-sm font-semibold text-gray-900 dark:text-white">Public Links</h4>
                                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Allow visiting guests to shorten links.</p>
                                    </div>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="hidden" name="enable_guest_links" value="0">
                                        <input type="checkbox" name="enable_guest_links" value="1" class="sr-only peer" {{ \App\Models\Setting::get('platform.enable_guest_links', true) ? 'checked' : '' }}>
                                        <div class="w-11 h-6 bg-gray-300 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-purple-300 dark:peer-focus:ring-purple-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-purple-600"></div>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- TAB: DATABASE -->
                    <div x-show="activeTab === 'database'" x-cloak>
                        <div class="flex justify-between items-start mb-8 rounded-xl bg-orange-50 dark:bg-orange-900/20 border border-orange-200 dark:border-orange-800 p-6">
                            <div>
                                <h1 class="text-lg font-bold text-orange-800 dark:text-orange-400">Database Configuration</h1>
                                <p class="text-sm text-orange-700 dark:text-orange-300 mt-1">Warning: Changing these settings might cause immediate database disconnection if incorrect.</p>
                            </div>
                            <svg class="w-6 h-6 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                            </svg>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div>
                                <label for="db_connection" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">DB Connection</label>
                                <select name="db_connection" id="db_connection" class="block w-full border-gray-200 dark:border-gray-700 dark:bg-[#1A1A22] dark:text-white focus:border-purple-500 focus:ring-purple-500 rounded-xl py-2.5 px-4 text-sm font-mono">
                                    <option value="mysql" {{ env('DB_CONNECTION') === 'mysql' ? 'selected' : '' }}>MySQL / MariaDB</option>
                                    <option value="sqlite" {{ env('DB_CONNECTION') === 'sqlite' ? 'selected' : '' }}>SQLite</option>
                                    <option value="pgsql" {{ env('DB_CONNECTION') === 'pgsql' ? 'selected' : '' }}>PostgreSQL</option>
                                </select>
                            </div>

                            <div>
                                <label for="db_host" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">DB Host</label>
                                <input type="text" name="db_host" id="db_host" value="{{ old('db_host', env('DB_HOST')) }}" class="block w-full border-gray-200 dark:border-gray-700 dark:bg-[#1A1A22] dark:text-white focus:border-purple-500 focus:ring-purple-500 rounded-xl py-2.5 px-4 text-sm font-mono">
                            </div>

                            <div>
                                <label for="db_port" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">DB Port</label>
                                <input type="number" name="db_port" id="db_port" value="{{ old('db_port', env('DB_PORT')) }}" class="block w-full border-gray-200 dark:border-gray-700 dark:bg-[#1A1A22] dark:text-white focus:border-purple-500 focus:ring-purple-500 rounded-xl py-2.5 px-4 text-sm font-mono">
                            </div>

                            <div>
                                <label for="db_database" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Database Name</label>
                                <input type="text" name="db_database" id="db_database" value="{{ old('db_database', env('DB_DATABASE')) }}" class="block w-full border-gray-200 dark:border-gray-700 dark:bg-[#1A1A22] dark:text-white focus:border-purple-500 focus:ring-purple-500 rounded-xl py-2.5 px-4 text-sm font-mono">
                            </div>

                            <div class="mb-6">
                                <label for="db_username" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">DB Username</label>
                                <input type="text" name="db_username" id="db_username" value="{{ old('db_username', env('DB_USERNAME')) }}" class="block w-full border-gray-200 dark:border-gray-700 dark:bg-[#1A1A22] dark:text-white focus:border-purple-500 focus:ring-purple-500 rounded-xl py-2.5 px-4 text-sm font-mono">
                            </div>

                            <div class="mb-6">
                                <label for="db_password" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">DB Password</label>
                                <input type="password" name="db_password" id="db_password" value="{{ old('db_password', env('DB_PASSWORD')) }}" class="block w-full border-gray-200 dark:border-gray-700 dark:bg-[#1A1A22] dark:text-white focus:border-purple-500 focus:ring-purple-500 rounded-xl py-2.5 px-4 text-sm font-mono">
                            </div>
                        </div>
                    </div>

                    <!-- TAB: MAIL -->
                    <div x-show="activeTab === 'mail'" x-cloak>
                        <div class="mb-8">
                            <h1 class="text-xl font-bold text-gray-900 dark:text-white">SMTP Settings</h1>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Settings for sending outgoing emails (password resets, etc).</p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div>
                                <label for="mail_mailer" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Mail Driver</label>
                                <select name="mail_mailer" id="mail_mailer" class="block w-full border-gray-200 dark:border-gray-700 dark:bg-[#1A1A22] dark:text-white focus:border-purple-500 focus:ring-purple-500 rounded-xl py-2.5 px-4 text-sm font-mono">
                                    <option value="smtp" {{ env('MAIL_MAILER') === 'smtp' ? 'selected' : '' }}>SMTP</option>
                                    <option value="log" {{ env('MAIL_MAILER') === 'log' ? 'selected' : '' }}>Log (Testing)</option>
                                    <option value="sendmail" {{ env('MAIL_MAILER') === 'sendmail' ? 'selected' : '' }}>Sendmail</option>
                                </select>
                            </div>

                            <div>
                                <label for="mail_host" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">SMTP Host</label>
                                <input type="text" name="mail_host" id="mail_host" value="{{ old('mail_host', env('MAIL_HOST')) }}" class="block w-full border-gray-200 dark:border-gray-700 dark:bg-[#1A1A22] dark:text-white focus:border-purple-500 focus:ring-purple-500 rounded-xl py-2.5 px-4 text-sm font-mono" placeholder="smtp.mailtrap.io">
                            </div>

                            <div>
                                <label for="mail_port" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">SMTP Port</label>
                                <input type="number" name="mail_port" id="mail_port" value="{{ old('mail_port', env('MAIL_PORT')) }}" class="block w-full border-gray-200 dark:border-gray-700 dark:bg-[#1A1A22] dark:text-white focus:border-purple-500 focus:ring-purple-500 rounded-xl py-2.5 px-4 text-sm font-mono">
                            </div>

                            <div>
                                <label for="mail_username" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">SMTP Username</label>
                                <input type="text" name="mail_username" id="mail_username" value="{{ env('MAIL_USERNAME') !== 'null' ? old('mail_username', env('MAIL_USERNAME')) : '' }}" class="block w-full border-gray-200 dark:border-gray-700 dark:bg-[#1A1A22] dark:text-white focus:border-purple-500 focus:ring-purple-500 rounded-xl py-2.5 px-4 text-sm font-mono">
                            </div>

                            <div>
                                <label for="mail_password" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">SMTP Password</label>
                                <input type="password" name="mail_password" id="mail_password" value="{{ env('MAIL_PASSWORD') !== 'null' ? old('mail_password', env('MAIL_PASSWORD')) : '' }}" class="block w-full border-gray-200 dark:border-gray-700 dark:bg-[#1A1A22] dark:text-white focus:border-purple-500 focus:ring-purple-500 rounded-xl py-2.5 px-4 text-sm font-mono">
                            </div>

                            <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-6 ">
                                <div class="mb-6">
                                    <label for="mail_from_address" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">From Address</label>
                                    <input type="email" name="mail_from_address" id="mail_from_address" value="{{ old('mail_from_address', env('MAIL_FROM_ADDRESS')) }}" class="block w-full border-gray-200 dark:border-gray-700 dark:bg-[#1A1A22] dark:text-white focus:border-purple-500 focus:ring-purple-500 rounded-xl py-2.5 px-4 text-sm font-mono">
                                </div>
                                <div class="mb-6">
                                    <label for="mail_from_name" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">From Name</label>
                                    <input type="text" name="mail_from_name" id="mail_from_name" value="{{ old('mail_from_name', env('MAIL_FROM_NAME', env('APP_NAME'))) }}" class="block w-full border-gray-200 dark:border-gray-700 dark:bg-[#1A1A22] dark:text-white focus:border-purple-500 focus:ring-purple-500 rounded-xl py-2.5 px-4 text-sm font-mono">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- TAB: SERVICES -->
                    <div x-show="activeTab === 'services'" x-cloak class="space-y-10">

                        <!-- Google OAuth -->
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                                Authentication (Google OAuth)
                            </h3>
                            <p class="text-sm text-gray-500 mb-8">Configure Google Login credentials. <a href="https://console.cloud.google.com/apis/credentials" target="_blank" class="text-purple-600 hover:underline">Get keys from Google</a>.</p>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-6 p-8 rounded-2xl border border-gray-100 dark:border-gray-800">
                                <div>
                                    <label for="google_client_id" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Google Client ID</label>
                                    <input type="text" name="google_client_id" id="google_client_id" value="{{ old('google_client_id', env('GOOGLE_CLIENT_ID')) }}" class="block w-full border-gray-200 dark:border-gray-700 dark:bg-[#1A1A22] dark:text-white focus:border-purple-500 focus:ring-purple-500 rounded-xl py-2.5 px-4 text-sm font-mono">
                                </div>
                                <div>
                                    <label for="google_client_secret" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Google Client Secret</label>
                                    <input type="password" name="google_client_secret" id="google_client_secret" value="{{ old('google_client_secret', env('GOOGLE_CLIENT_SECRET')) }}" class="block w-full border-gray-200 dark:border-gray-700 dark:bg-[#1A1A22] dark:text-white focus:border-purple-500 focus:ring-purple-500 rounded-xl py-2.5 px-4 text-sm font-mono">
                                </div>
                                <div class="md:col-span-2 mt-2">
                                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Authorised Redirect URI</label>
                                    <div class="flex items-center gap-3">
                                        <input type="text" readonly value="{{ url('/auth/google/callback') }}" class="block w-full border-gray-200 dark:border-gray-700 bg-gray-100 dark:bg-[#121217] text-gray-500 rounded-xl py-2.5 px-4 text-sm font-mono shadow-sm cursor-not-allowed">
                                        <button type="button" onclick="navigator.clipboard.writeText('{{ url('/auth/google/callback') }}'); alert('Copied Redirect URI!');" class="p-2.5 bg-white dark:bg-[#1A1A22] rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors text-gray-500 hover:text-purple-600 flex-shrink-0">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                            </svg>
                                        </button>
                                    </div>
                                    <p class="mt-1.5 text-xs text-gray-500">Copy this exact URL into Google Cloud Console.</p>
                                </div>
                            </div>
                        </div>

                        <!-- hCaptcha -->
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916 13.916 0 008 11a4 4 0 118 0c0 1.017-.07 2.019-.203 3m-2.118 6.844A21.88 21.88 0 0015.171 17m3.839 1.132c.645-2.266.99-4.659.99-7.132A8 8 0 008 4.07M3 15.364c.64-1.319 1-2.8 1-4.364 0-1.457.39-2.823 1.07-4"></path>
                                </svg>
                                Bot Protection (hCaptcha)
                            </h3>
                            <p class="text-sm text-gray-500 mb-8">Configure hCaptcha for guest link creation. <a href="https://dashboard.hcaptcha.com" target="_blank" class="text-purple-600 hover:underline">Get keys from hCaptcha</a>.</p>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 p-8 rounded-2xl border border-gray-100 dark:border-gray-800">
                                <div>
                                    <label for="hcaptcha_sitekey" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Sitekey</label>
                                    <input type="text" name="hcaptcha_sitekey" id="hcaptcha_sitekey" value="{{ old('hcaptcha_sitekey', env('HCAPTCHA_SITEKEY')) }}" class="block w-full border-gray-200 dark:border-gray-700 dark:bg-[#1A1A22] dark:text-white focus:border-purple-500 focus:ring-purple-500 rounded-xl py-2.5 px-4 text-sm font-mono">
                                </div>
                                <div>
                                    <label for="hcaptcha_secret" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Secret Key</label>
                                    <input type="password" name="hcaptcha_secret" id="hcaptcha_secret" value="{{ old('hcaptcha_secret', env('HCAPTCHA_SECRET')) }}" class="block w-full border-gray-200 dark:border-gray-700 dark:bg-[#1A1A22] dark:text-white focus:border-purple-500 focus:ring-purple-500 rounded-xl py-2.5 px-4 text-sm font-mono">
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- TAB: ADVANCED / SEO -->
                    <div x-show="activeTab === 'advanced'" x-cloak class="space-y-10">

                        <!-- SEO Box -->
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-6">SEO & Metadata</h3>
                            <div class="grid grid-cols-1 gap-8">
                                <div>
                                    <label for="meta_title" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Default Meta Title</label>
                                    <input type="text" name="meta_title" id="meta_title" value="{{ \App\Models\Setting::get('platform.meta_title', 'ScrollWebLink - High Performance URL Shortener') }}" placeholder="e.g. My URL Shortener - Fast & Reliable" class="block w-full border-gray-200 dark:border-gray-700 dark:bg-[#1A1A22] dark:text-white focus:border-purple-500 focus:ring-purple-500 rounded-xl py-2.5 px-4 text-sm">
                                </div>
                                <div>
                                    <label for="meta_description" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Default Meta Description</label>
                                    <textarea name="meta_description" id="meta_description" rows="3" placeholder="e.g. Create short, memorable links instantly. Track clicks, manage URLs, and improve your marketing." class="block w-full border-gray-200 dark:border-gray-700 dark:bg-[#1A1A22] dark:text-white focus:border-purple-500 focus:ring-purple-500 rounded-xl py-2.5 px-4 text-sm">{{ \App\Models\Setting::get('platform.meta_description') }}</textarea>
                                </div>
                                <div class="mb-6">
                                    <label for="meta_keywords" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Default Meta Keywords</label>
                                    <input type="text" name="meta_keywords" id="meta_keywords" value="{{ \App\Models\Setting::get('platform.meta_keywords', 'url shortener, link tracker') }}" placeholder="e.g. shortlink, url shortener, tracker, bio link" class="block w-full border-gray-200 dark:border-gray-700 dark:bg-[#1A1A22] dark:text-white focus:border-purple-500 focus:ring-purple-500 rounded-xl py-2.5 px-4 text-sm">
                                </div>
                            </div>
                        </div>

                        <!-- Page Beahvior -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="mb-6">
                                <label for="redirect_duration" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Redirect Duration (Seconds)</label>
                                <input type="number" name="redirect_duration" id="redirect_duration" value="{{ \App\Models\Setting::get('platform.redirect_duration', 10) }}" class="block w-full border-gray-200 dark:border-gray-700 dark:bg-[#1A1A22] dark:text-white focus:border-purple-500 focus:ring-purple-500 rounded-xl py-2.5 px-4 text-sm">
                                <p class="mt-1.5 text-xs text-gray-500">Wait time on countdown page.</p>
                            </div>
                        </div>

                        <!-- Injection Scripts -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-6 border-t border-gray-100 dark:border-gray-800">
                            <div class="mb-6">
                                <label for="analytics_script" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Analytics / Custom Script HEAD</label>
                                <textarea name="analytics_script" id="analytics_script" rows="4" class="block w-full font-mono text-xs border-gray-200 dark:border-gray-700 dark:bg-[#1A1A22] dark:text-white focus:border-purple-500 focus:ring-purple-500 rounded-xl py-2.5 px-4">{{ \App\Models\Setting::get('platform.analytics_script') }}</textarea>
                            </div>
                            <div class="mb-6">
                                <label for="adsense_script" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">AdSense / Custom Script BODY</label>
                                <textarea name="adsense_script" id="adsense_script" rows="4" class="block w-full font-mono text-xs border-gray-200 dark:border-gray-700 dark:bg-[#1A1A22] dark:text-white focus:border-purple-500 focus:ring-purple-500 rounded-xl py-2.5 px-4">{{ \App\Models\Setting::get('platform.adsense_script') }}</textarea>
                            </div>
                        </div>

                        <!-- Redis Server -->
                        <div class="pt-6 ">
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Redis Configuration</h3>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div>
                                    <label for="redis_host" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Redis Host</label>
                                    <input type="text" name="redis_host" id="redis_host" value="{{ old('redis_host', env('REDIS_HOST', '127.0.0.1')) }}" class="block w-full border-gray-200 dark:border-gray-700 dark:bg-[#1A1A22] dark:text-white focus:border-purple-500 focus:ring-purple-500 rounded-xl py-2.5 px-4 text-sm font-mono">
                                </div>
                                <div>
                                    <label for="redis_password" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Redis Password</label>
                                    <input type="password" name="redis_password" id="redis_password" value="{{ env('REDIS_PASSWORD') !== 'null' ? old('redis_password', env('REDIS_PASSWORD')) : '' }}" class="block w-full border-gray-200 dark:border-gray-700 dark:bg-[#1A1A22] dark:text-white focus:border-purple-500 focus:ring-purple-500 rounded-xl py-2.5 px-4 text-sm font-mono">
                                </div>
                                <div>
                                    <label for="redis_port" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Redis Port</label>
                                    <input type="number" name="redis_port" id="redis_port" value="{{ old('redis_port', env('REDIS_PORT', 6379)) }}" class="block w-full border-gray-200 dark:border-gray-700 dark:bg-[#1A1A22] dark:text-white focus:border-purple-500 focus:ring-purple-500 rounded-xl py-2.5 px-4 text-sm font-mono">
                                </div>
                            </div>
                        </div>

                        <!-- AWS / S3 -->
                        <div class="pt-6 ">
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">AWS S3 Configuration</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="aws_access_key_id" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">AWS Access Key ID</label>
                                    <input type="text" name="aws_access_key_id" id="aws_access_key_id" value="{{ old('aws_access_key_id', env('AWS_ACCESS_KEY_ID')) }}" class="block w-full border-gray-200 dark:border-gray-700 dark:bg-[#1A1A22] dark:text-white focus:border-purple-500 focus:ring-purple-500 rounded-xl py-2.5 px-4 text-sm font-mono">
                                </div>
                                <div>
                                    <label for="aws_secret_access_key" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">AWS Secret</label>
                                    <input type="password" name="aws_secret_access_key" id="aws_secret_access_key" value="{{ old('aws_secret_access_key', env('AWS_SECRET_ACCESS_KEY')) }}" class="block w-full border-gray-200 dark:border-gray-700 dark:bg-[#1A1A22] dark:text-white focus:border-purple-500 focus:ring-purple-500 rounded-xl py-2.5 px-4 text-sm font-mono">
                                </div>
                                <div class="mb-6">
                                    <label for="aws_default_region" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">AWS Region</label>
                                    <input type="text" name="aws_default_region" id="aws_default_region" value="{{ old('aws_default_region', env('AWS_DEFAULT_REGION', 'us-east-1')) }}" class="block w-full border-gray-200 dark:border-gray-700 dark:bg-[#1A1A22] dark:text-white focus:border-purple-500 focus:ring-purple-500 rounded-xl py-2.5 px-4 text-sm font-mono" placeholder="us-east-1">
                                </div>
                                <div class="mb-6">
                                    <label for="aws_bucket" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">AWS Bucket</label>
                                    <input type="text" name="aws_bucket" id="aws_bucket" value="{{ old('aws_bucket', env('AWS_BUCKET')) }}" class="block w-full border-gray-200 dark:border-gray-700 dark:bg-[#1A1A22] dark:text-white focus:border-purple-500 focus:ring-purple-500 rounded-xl py-2.5 px-4 text-sm font-mono">
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- TAB: ADS BANNER -->
                    <div x-show="activeTab === 'ads'" x-cloak class="space-y-10">
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-1">Ads Banner Settings</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Paste your AdSense or Adsterra script code into the slots below to display ads on the front page. Supported: Google AdSense, Adsterra, Ezoic, and more.</p>
                        </div>

                        <!-- Header Script (auto-loaded) -->
                        <div class="p-6 rounded-2xl border border-gray-100 dark:border-gray-800 bg-gray-50/50 dark:bg-[#1A1A22]/50">
                            <div class="flex items-center gap-3 mb-4">
                                <div class="w-9 h-9 rounded-xl bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center text-blue-600 dark:text-blue-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="text-sm font-bold text-gray-900 dark:text-white">Header Script (AdSense Setup / Global)</h4>
                                    <p class="text-xs text-gray-500">Injected in &lt;head&gt;. Use for AdSense publisher script or any global ad script.</p>
                                </div>
                            </div>
                            <textarea name="adsense_script" id="adsense_script" rows="5" placeholder="e.g. &lt;script async src=&quot;https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-XXXXXXX&quot;&gt;&lt;/script&gt;" class="block w-full font-mono text-xs border-gray-200 dark:border-gray-700 dark:bg-[#121217] dark:text-white focus:border-purple-500 focus:ring-purple-500 rounded-xl py-2.5 px-4">{{ \App\Models\Setting::get('platform.adsense_script') }}</textarea>
                        </div>

                        <!-- Top Banner -->
                        <div class="p-6 rounded-2xl border border-gray-100 dark:border-gray-800 bg-gray-50/50 dark:bg-[#1A1A22]/50">
                            <div class="flex items-center gap-3 mb-4">
                                <div class="w-9 h-9 rounded-xl bg-orange-100 dark:bg-orange-900/30 flex items-center justify-center text-orange-600 dark:text-orange-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 11l7-7 7 7M5 19l7-7 7 7"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="text-sm font-bold text-gray-900 dark:text-white">Top Banner Ad</h4>
                                    <p class="text-xs text-gray-500">Displayed below the hero section header on the front page.</p>
                                </div>
                            </div>
                            <textarea name="ads_top_banner" id="ads_top_banner" rows="5" placeholder="e.g. &lt;ins class=&quot;adsbygoogle&quot; ...&gt;&lt;/ins&gt;" class="block w-full font-mono text-xs border-gray-200 dark:border-gray-700 dark:bg-[#121217] dark:text-white focus:border-purple-500 focus:ring-purple-500 rounded-xl py-2.5 px-4">{{ \App\Models\Setting::get('platform.ads_top_banner') }}</textarea>
                        </div>

                        <!-- Middle Banner -->
                        <div class="p-6 rounded-2xl border border-gray-100 dark:border-gray-800 bg-gray-50/50 dark:bg-[#1A1A22]/50">
                            <div class="flex items-center gap-3 mb-4">
                                <div class="w-9 h-9 rounded-xl bg-purple-100 dark:bg-purple-900/30 flex items-center justify-center text-purple-600 dark:text-purple-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="text-sm font-bold text-gray-900 dark:text-white">Middle Banner Ad</h4>
                                    <p class="text-xs text-gray-500">Displayed between the "How It Works" and pricing sections.</p>
                                </div>
                            </div>
                            <textarea name="ads_mid_banner" id="ads_mid_banner" rows="5" placeholder="e.g. &lt;ins class=&quot;adsbygoogle&quot; ...&gt;&lt;/ins&gt;" class="block w-full font-mono text-xs border-gray-200 dark:border-gray-700 dark:bg-[#121217] dark:text-white focus:border-purple-500 focus:ring-purple-500 rounded-xl py-2.5 px-4">{{ \App\Models\Setting::get('platform.ads_mid_banner') }}</textarea>
                        </div>

                        <!-- Bottom Banner -->
                        <div class="p-6 rounded-2xl border border-gray-100 dark:border-gray-800 bg-gray-50/50 dark:bg-[#1A1A22]/50">
                            <div class="flex items-center gap-3 mb-4">
                                <div class="w-9 h-9 rounded-xl bg-green-100 dark:bg-green-900/30 flex items-center justify-center text-green-600 dark:text-green-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 13l-7 7-7-7m14-8l-7 7-7-7"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="text-sm font-bold text-gray-900 dark:text-white">Bottom Banner Ad</h4>
                                    <p class="text-xs text-gray-500">Displayed above the footer on the front page.</p>
                                </div>
                            </div>
                            <textarea name="ads_bottom_banner" id="ads_bottom_banner" rows="5" placeholder="e.g. &lt;ins class=&quot;adsbygoogle&quot; ...&gt;&lt;/ins&gt;" class="block w-full font-mono text-xs border-gray-200 dark:border-gray-700 dark:bg-[#121217] dark:text-white focus:border-purple-500 focus:ring-purple-500 rounded-xl py-2.5 px-4">{{ \App\Models\Setting::get('platform.ads_bottom_banner') }}</textarea>
                        </div>

                        <!-- Redirect Page Ads Divider -->
                        <div class="pt-2 pb-2">
                            <div class="flex items-center gap-3">
                                <div class="flex-1 h-px bg-gray-200 dark:bg-gray-700"></div>
                                <span class="text-xs font-bold uppercase tracking-widest text-gray-400 dark:text-gray-500 px-2">Redirect / Countdown Page</span>
                                <div class="flex-1 h-px bg-gray-200 dark:bg-gray-700"></div>
                            </div>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-2 text-center">Ads displayed on the intermediate redirect countdown page when a user clicks a short link.</p>
                        </div>

                        <!-- Redirect Top Ad -->
                        <div class="p-6 rounded-2xl border border-gray-100 dark:border-gray-800 bg-gray-50/50 dark:bg-[#1A1A22]/50">
                            <div class="flex items-center gap-3 mb-4">
                                <div class="w-9 h-9 rounded-xl bg-orange-100 dark:bg-orange-900/30 flex items-center justify-center text-orange-600 dark:text-orange-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 11l7-7 7 7M5 19l7-7 7 7"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="text-sm font-bold text-gray-900 dark:text-white">Redirect Page — Top Ad</h4>
                                    <p class="text-xs text-gray-500">Displayed at the top of the countdown/redirect page.</p>
                                </div>
                            </div>
                            <textarea name="ads_redirect_top" id="ads_redirect_top" rows="5" placeholder="e.g. &lt;ins class=&quot;adsbygoogle&quot; ...&gt;&lt;/ins&gt;" class="block w-full font-mono text-xs border-gray-200 dark:border-gray-700 dark:bg-[#121217] dark:text-white focus:border-purple-500 focus:ring-purple-500 rounded-xl py-2.5 px-4">{{ \App\Models\Setting::get('platform.ads_redirect_top') }}</textarea>
                        </div>

                        <!-- Redirect Bottom Ad -->
                        <div class="p-6 rounded-2xl border border-gray-100 dark:border-gray-800 bg-gray-50/50 dark:bg-[#1A1A22]/50">
                            <div class="flex items-center gap-3 mb-4">
                                <div class="w-9 h-9 rounded-xl bg-green-100 dark:bg-green-900/30 flex items-center justify-center text-green-600 dark:text-green-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 13l-7 7-7-7m14-8l-7 7-7-7"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="text-sm font-bold text-gray-900 dark:text-white">Redirect Page — Bottom Ad</h4>
                                    <p class="text-xs text-gray-500">Displayed at the bottom of the countdown/redirect page.</p>
                                </div>
                            </div>
                            <textarea name="ads_redirect_bottom" id="ads_redirect_bottom" rows="5" placeholder="e.g. &lt;ins class=&quot;adsbygoogle&quot; ...&gt;&lt;/ins&gt;" class="block w-full font-mono text-xs border-gray-200 dark:border-gray-700 dark:bg-[#121217] dark:text-white focus:border-purple-500 focus:ring-purple-500 rounded-xl py-2.5 px-4">{{ \App\Models\Setting::get('platform.ads_redirect_bottom') }}</textarea>
                        </div>

                        <div class="p-4 rounded-xl bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 text-sm text-blue-700 dark:text-blue-400">
                            <p class="font-bold mb-1">💡 Tips:</p>
                            <ul class="list-disc list-inside space-y-1 text-xs">
                                <li>For Google AdSense, paste the &lt;ins&gt; ad unit code into Top / Middle / Bottom Banner</li>
                                <li>For Adsterra, paste the full &lt;script&gt; banner code into the desired slot</li>
                                <li>Leave a slot empty to hide that ad position</li>
                            </ul>
                        </div>
                    </div>

                    <!-- End of TAB: ADS -->
                    <p class="text-xs text-gray-500">Some environment changes won't be visible until a server refresh.</p>
                    <button type="submit" class="inline-flex items-center gap-2 py-3 px-8 rounded-xl bg-purple-600 text-white text-sm font-bold hover:bg-purple-700 transition-all shadow-md active:scale-95">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path>
                        </svg>
                        Save Settings to Server
                    </button>
            </div>
            </form>
        </div>
    </div>

</x-app-layout>
