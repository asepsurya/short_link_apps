<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold text-gray-900 dark:text-white mt-1">Admin Dashboard</h2>
    </x-slot>

    <!-- Stats Row -->
    <div class="mb-8 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Platform Overview</h1>
            <p class="text-gray-500 dark:text-gray-400 text-sm mt-1">Monitor all users and links across ScrollWebLink.</p>
        </div>
        <a href="{{ route('admin.users') }}" class="inline-flex items-center gap-2 py-2.5 px-5 rounded-xl bg-purple-600 text-white text-sm font-semibold hover:bg-purple-700 transition-colors shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
            </svg>
            Manage Users
        </a>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white dark:bg-[#121217] rounded-2xl p-6 border border-gray-100 dark:border-gray-800 shadow-sm relative overflow-hidden group">
            <div class="absolute -right-6 -top-6 w-24 h-24 bg-blue-500/10 rounded-full blur-xl group-hover:bg-blue-500/20 transition-colors"></div>
            <div class="w-10 h-10 rounded-xl bg-blue-100 dark:bg-blue-900/40 flex items-center justify-center text-blue-600 dark:text-blue-400 mb-4">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                </svg>
            </div>
            <p class="text-sm text-gray-500 dark:text-gray-400 font-medium mb-1">Total Users</p>
            <h3 class="text-3xl font-bold text-gray-900 dark:text-white">{{ number_format($totalUsers) }}</h3>
        </div>

        <div class="bg-white dark:bg-[#121217] rounded-2xl p-6 border border-gray-100 dark:border-gray-800 shadow-sm relative overflow-hidden group">
            <div class="absolute -right-6 -top-6 w-24 h-24 bg-purple-500/10 rounded-full blur-xl group-hover:bg-purple-500/20 transition-colors"></div>
            <div class="w-10 h-10 rounded-xl bg-purple-100 dark:bg-purple-900/40 flex items-center justify-center text-purple-600 dark:text-purple-400 mb-4">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                </svg>
            </div>
            <p class="text-sm text-gray-500 dark:text-gray-400 font-medium mb-1">Total Links</p>
            <h3 class="text-3xl font-bold text-gray-900 dark:text-white">{{ number_format($totalLinks) }}</h3>
        </div>

        <div class="bg-white dark:bg-[#121217] rounded-2xl p-6 border border-gray-100 dark:border-gray-800 shadow-sm relative overflow-hidden group">
            <div class="absolute -right-6 -top-6 w-24 h-24 bg-green-500/10 rounded-full blur-xl group-hover:bg-green-500/20 transition-colors"></div>
            <div class="w-10 h-10 rounded-xl bg-green-100 dark:bg-green-900/40 flex items-center justify-center text-green-600 dark:text-green-400 mb-4">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122"></path>
                </svg>
            </div>
            <p class="text-sm text-gray-500 dark:text-gray-400 font-medium mb-1">Total Clicks</p>
            <h3 class="text-3xl font-bold text-gray-900 dark:text-white">{{ number_format($totalClicks) }}</h3>
        </div>

        <!-- API Requests (Admin Only) -->
        <div class="bg-white dark:bg-[#121217] rounded-2xl p-6 border border-gray-100 dark:border-gray-800 shadow-sm relative overflow-hidden group">
            <div class="absolute -right-6 -top-6 w-24 h-24 bg-orange-500/10 rounded-full blur-xl group-hover:bg-orange-500/20 transition-colors"></div>
            <div class="w-10 h-10 rounded-xl bg-orange-100 dark:bg-orange-900/40 flex items-center justify-center text-orange-600 dark:text-orange-400 mb-4">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                </svg>
            </div>
            <p class="text-sm text-gray-500 dark:text-gray-400 font-medium mb-1">API Requests</p>
            <h3 class="text-3xl font-bold text-gray-900 dark:text-white">{{ number_format($totalApiRequests) }}</h3>
            <div class="w-full bg-gray-200 dark:bg-gray-800 rounded-full h-1.5 mt-2">
                @php
                    $rateLimit = (int) Cache::get('platform.api_rate_limit', 60);
                    $percentage = min(100, ($totalApiRequests / max(1, $rateLimit * 1440)) * 100); // 1440 mins in day
                @endphp
                <div class="bg-orange-500 h-1.5 rounded-full" style="width: {{ $percentage }}%"></div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
        <div class="xl:col-span-2 space-y-6">
            <!-- Recent Users Table -->
            <div class="bg-white dark:bg-[#121217] rounded-2xl border border-gray-100 dark:border-gray-800 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-800 flex items-center justify-between">
                    <h3 class="text-base font-bold text-gray-900 dark:text-white">Recent Users</h3>
                    <a href="{{ route('admin.users') }}" class="text-xs font-semibold text-purple-600 dark:text-purple-400 hover:underline">View all →</a>
                </div>
                <ul class="divide-y divide-gray-100 dark:divide-gray-800">
                    @foreach($recentUsers as $user)
                    <li class="flex items-center justify-between px-6 py-4 hover:bg-gray-50 dark:hover:bg-[#1A1A22] transition-colors">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-full bg-purple-100 dark:bg-purple-900/40 flex items-center justify-center text-purple-600 dark:text-purple-400 font-bold text-sm shrink-0">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-gray-900 dark:text-white flex items-center gap-2">
                                    {{ $user->name }}
                                    @if($user->role === 'admin')
                                    <span class="text-[10px] font-bold uppercase tracking-wider bg-purple-100 dark:bg-purple-900/40 text-purple-700 dark:text-purple-400 px-1.5 py-0.5 rounded">Admin</span>
                                    @endif
                                </p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">{{ $user->email }}</p>
                            </div>
                        </div>
                        <span class="text-xs text-gray-400 dark:text-gray-500 whitespace-nowrap">{{ $user->created_at->diffForHumans() }}</span>
                    </li>
                    @endforeach
                </ul>
            </div>

            <!-- Guest Link History Table -->
            <div class="bg-white dark:bg-[#121217] rounded-2xl border border-gray-100 dark:border-gray-800 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-800 flex items-center justify-between">
                    <div>
                        <h3 class="text-base font-bold text-gray-900 dark:text-white">Guest Link History</h3>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">Recent links created by public/unauthenticated users.</p>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse border-b border-gray-100 dark:border-gray-800">
                        <thead>
                            <tr class="bg-gray-50/50 dark:bg-[#0D0D11]/50">
                                <th class="px-4 py-3 text-[10px] font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400 border-b border-gray-100 dark:border-gray-800">#</th>
                                <th class="px-6 py-3 text-[10px] font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400 border-b border-gray-100 dark:border-gray-800">Short URL</th>
                                <th class="px-6 py-3 text-[10px] font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400 border-b border-gray-100 dark:border-gray-800">Original URL</th>
                                <th class="px-6 py-3 text-[10px] font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400 border-b border-gray-100 dark:border-gray-800">Creator IP</th>
                                <th class="px-6 py-3 text-[10px] font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400 border-b border-gray-100 dark:border-gray-800">Clicks</th>
                                <th class="px-6 py-3 text-[10px] font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400 border-b border-gray-100 dark:border-gray-800 text-right">Created</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                            @forelse($guestLinks as $link)
                            <tr class="hover:bg-gray-50 dark:hover:bg-[#1A1A22] transition-colors group">
                                <td class="px-4 py-4 whitespace-nowrap text-[10px] font-medium text-gray-500 dark:text-gray-400">
                                    {{ ($guestLinks->currentPage() - 1) * $guestLinks->perPage() + $loop->iteration }}
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{ url($link->short_code) }}" target="_blank" class="text-sm font-semibold text-purple-600 dark:text-purple-400 hover:underline">
                                        /{{ $link->short_code }}
                                    </a>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900 dark:text-white truncate max-w-[120px]" title="{{ $link->original_url }}">
                                        {{ $link->original_url }}
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-0.5 bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-400 rounded text-[10px] font-mono border border-gray-200 dark:border-gray-700">
                                        {{ $link->creator_ip ?? 'Unknown' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-sm font-bold text-gray-900 dark:text-white">{{ number_format($link->clicks_count) }}</span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <span class="text-[10px] text-gray-500 dark:text-gray-500 whitespace-nowrap">{{ $link->created_at->diffForHumans() }}</span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-10 text-center">
                                    <p class="text-gray-500 dark:text-gray-400 text-xs">No guest links found.</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Platform Settings -->
        <div class="space-y-5">
            <!-- Redirect Page Toggle Card -->
            <div class="bg-white dark:bg-[#121217] rounded-2xl border border-gray-100 dark:border-gray-800 shadow-sm p-6">
                <h3 class="text-base font-bold text-gray-900 dark:text-white mb-1 flex items-center gap-2">
                    <div class="w-7 h-7 rounded-lg bg-purple-100 dark:bg-purple-900/40 flex items-center justify-center text-purple-600 dark:text-purple-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    Platform Settings
                </h3>
                <p class="text-xs text-gray-500 dark:text-gray-400 mb-5">Toggle global features for all users.</p>

                <div class="space-y-4">
                    <!-- 10s Redirect Toggle -->
                    <div class="flex items-center justify-between gap-4 p-4 bg-gray-50 dark:bg-[#0D0D11] rounded-xl border border-gray-100 dark:border-gray-800">
                        <div>
                            <p class="text-sm font-semibold text-gray-900 dark:text-white">10‑second Redirect Page</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">Enable/disable platform-wide for all new links.</p>
                            <p class="text-[10px] text-purple-500 mt-1 font-medium">Users can override this per link.</p>
                        </div>
                        <form method="POST" action="{{ route('admin.settings.redirect') }}" class="shrink-0">
                            @csrf
                            @method('PATCH')
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="hidden" name="use_redirect_page" value="0">
                                <input type="checkbox" name="use_redirect_page" value="1" class="sr-only peer" {{ config('app.default_redirect_page', true) ? 'checked' : '' }} onchange="this.form.submit()">
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-purple-300 dark:peer-focus:ring-purple-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-purple-600"></div>
                            </label>
                        </form>
                    </div>

                    <!-- Batch Update Button -->
                    <form method="POST" action="{{ route('admin.links.batch-redirect') }}">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="use_redirect_page" value="1">
                        <button type="submit" onclick="return confirm('Apply 10-second redirect page to ALL existing links?')" class="w-full py-2.5 px-4 rounded-xl text-sm font-semibold text-white bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700 transition-colors">
                            Enable on All Existing Links
                        </button>
                    </form>
                    <form method="POST" action="{{ route('admin.links.batch-redirect') }}">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="use_redirect_page" value="0">
                        <button type="submit" onclick="return confirm('Disable redirect page for ALL existing links?')" class="w-full py-2.5 px-4 rounded-xl text-sm font-semibold text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors">
                            Disable on All Existing Links
                        </button>
                    </form>
                </div>
            </div>

            <!-- API Settings Card -->
            <div class="bg-white dark:bg-[#121217] rounded-2xl border border-gray-100 dark:border-gray-800 shadow-sm p-6">
                <h3 class="text-base font-bold text-gray-900 dark:text-white mb-1 flex items-center gap-2">
                    <div class="w-7 h-7 rounded-lg bg-blue-100 dark:bg-blue-900/40 flex items-center justify-center text-blue-600 dark:text-blue-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                        </svg>
                    </div>
                    API Configuration
                </h3>
                <p class="text-xs text-gray-500 dark:text-gray-400 mb-5">Manage developer access and rate limits.</p>

                <form method="POST" action="{{ route('admin.settings.update-api') }}" class="space-y-4">
                    @csrf
                    @method('PATCH')

                    <div class="p-4 bg-gray-50 dark:bg-[#0D0D11] rounded-xl border border-gray-100 dark:border-gray-800">
                        <div class="flex items-center justify-between mb-3">
                            <label class="text-sm font-semibold text-gray-900 dark:text-white">Public API Access</label>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="hidden" name="api_enabled" value="0">
                                <input type="checkbox" name="api_enabled" value="1" class="sr-only peer" {{ Cache::get('platform.api_enabled', true) ? 'checked' : '' }}>
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                            </label>
                        </div>
                        
                        <div>
                            <label class="block text-[11px] font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-2">Requests Per Minute (RPM)</label>
                            <input type="number" name="api_rate_limit" value="{{ Cache::get('platform.api_rate_limit', 60) }}" class="block w-full border-gray-200 dark:border-gray-700 dark:bg-[#1A1A22] dark:text-white focus:border-blue-500 focus:ring-blue-500 rounded-xl py-2 px-3 text-sm transition-colors" placeholder="e.g. 60">
                        </div>
                    </div>

                    <button type="submit" class="w-full py-2.5 px-4 rounded-xl text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 transition-colors shadow-sm">
                        Save API Settings
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
