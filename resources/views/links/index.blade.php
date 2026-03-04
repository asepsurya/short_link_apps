<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold text-gray-900 dark:text-white mt-1">My Links</h2>
    </x-slot>

    <div class="mb-8 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Manage Links</h1>
            <p class="text-gray-500 dark:text-gray-400 text-sm mt-1">Create, edit and track your short links.</p>
        </div>
    </div>

    @if(session('success'))
    <div class="mb-6 flex items-center gap-3 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 text-green-700 dark:text-green-400 px-4 py-3 rounded-xl">
        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
        <span>{{ session('success') }}</span>
    </div>
    @endif

    @if($errors->any())
    <div class="mb-6 flex items-center gap-3 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 text-red-700 dark:text-red-400 px-4 py-3 rounded-xl">
        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
        <ul class="list-disc list-inside text-sm">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
    </div>
    @endif

    <!-- Create New Link Card -->
    <div class="bg-white dark:bg-[#121217] rounded-2xl border border-gray-100 dark:border-gray-800 shadow-sm p-6 mb-6" x-data="{ showAdvanced: false }">
        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-5 flex items-center gap-2">
            <div class="w-8 h-8 rounded-lg bg-purple-100 dark:bg-purple-900/40 flex items-center justify-center text-purple-600 dark:text-purple-400">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
            </div>
            Create New Short Link
        </h3>

        <form action="{{ route('links.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                <div class="lg:col-span-2">
                    <label for="original_url" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Destination URL <span class="text-red-500">*</span></label>
                    <input type="url" name="original_url" id="original_url" required placeholder="https://example.com/very-long-url-here" class="block w-full border-gray-200 dark:border-gray-700 dark:bg-[#1A1A22] dark:text-white focus:border-purple-500 focus:ring-purple-500 rounded-xl py-2.5 px-4 text-sm transition-colors" value="{{ old('original_url') }}">
                </div>
                <div>
                    <label for="custom_slug" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Custom Slug (Optional)</label>
                    <div class="flex items-center border border-gray-200 dark:border-gray-700 rounded-xl overflow-hidden bg-white dark:bg-[#1A1A22] focus-within:ring-2 focus-within:ring-purple-500 focus-within:border-purple-500 transition-all">
                        <span class="px-3 text-sm text-gray-400 dark:text-gray-500 shrink-0 border-r border-gray-200 dark:border-gray-700 py-2.5 bg-gray-50 dark:bg-[#121217]">{{ str_replace(['http://', 'https://'], '', config('app.url')) }}/</span>
                        <input type="text" name="custom_slug" id="custom_slug" placeholder="my-promo" class="flex-1 border-none focus:ring-0 bg-transparent text-sm py-2.5 px-3 text-gray-900 dark:text-white" value="{{ old('custom_slug') }}">
                    </div>
                </div>
            </div>

            <div class="mt-4 flex flex-col md:flex-row md:items-center justify-between gap-4">
                @if(Auth::user()->role === 'admin')
                <div class="flex items-center justify-between bg-white dark:bg-[#1A1A22] border border-gray-200 dark:border-gray-800 rounded-xl px-4 py-2.5 shadow-sm">
                    <div>
                        <p class="text-sm font-semibold text-gray-900 dark:text-white">10‑second Redirect Page</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">Show a countdown before redirecting.</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer ml-4 shrink-0">
                        <input type="hidden" name="use_redirect_page" value="0">
                        <input type="checkbox" name="use_redirect_page" value="1" class="sr-only peer" checked>
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-purple-300 dark:peer-focus:ring-purple-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-purple-600"></div>
                    </label>
                </div>
                @endif

                <div class="flex items-center gap-4">
                    @if(Auth::user()->role === 'admin')
                    <button type="button" @click="showAdvanced = !showAdvanced" class="text-sm text-purple-600 dark:text-purple-400 hover:underline flex items-center gap-1 font-medium">
                        <svg class="w-4 h-4" :class="{'rotate-180': showAdvanced}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                        <span x-text="showAdvanced ? 'Hide Advanced Options' : 'Show Advanced Options'"></span>
                    </button>
                    @endif
                    <button type="submit" class="inline-flex items-center gap-2 py-2.5 px-6 rounded-xl bg-purple-600 text-white text-sm font-semibold hover:bg-purple-700 focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 transition-colors shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                        </svg>
                        Shorten URL
                    </button>
                </div>
            </div>

            @if(Auth::user()->role === 'admin')
            <div x-show="showAdvanced" x-collapse style="display: none;" class="mt-6 pt-6 border-t border-gray-100 dark:border-gray-800">
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Password Protection</label>
                        <input type="password" name="password" placeholder="Leave empty for public" class="block w-full border-gray-200 dark:border-gray-700 dark:bg-[#1A1A22] dark:text-white focus:border-purple-500 focus:ring-purple-500 rounded-xl py-2.5 px-4 text-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Expiration Date</label>
                        <input type="datetime-local" name="expires_at" class="block w-full border-gray-200 dark:border-gray-700 dark:bg-[#1A1A22] dark:text-white focus:border-purple-500 focus:ring-purple-500 rounded-xl py-2.5 px-4 text-sm" value="{{ old('expires_at') }}">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Redirect Type</label>
                        <select name="redirect_type" class="block w-full border-gray-200 dark:border-gray-700 dark:bg-[#1A1A22] dark:text-white focus:border-purple-500 focus:ring-purple-500 rounded-xl py-2.5 px-4 text-sm">
                            <option value="302">302 – Temporary (best for analytics)</option>
                            <option value="301">301 – Permanent (best for SEO)</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">UTM Source</label>
                        <input type="text" name="utm_source" placeholder="e.g. google, newsletter" class="block w-full border-gray-200 dark:border-gray-700 dark:bg-[#1A1A22] dark:text-white focus:border-purple-500 focus:ring-purple-500 rounded-xl py-2.5 px-4 text-sm" value="{{ old('utm_source') }}">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">UTM Medium</label>
                        <input type="text" name="utm_medium" placeholder="e.g. cpc, email, social" class="block w-full border-gray-200 dark:border-gray-700 dark:bg-[#1A1A22] dark:text-white focus:border-purple-500 focus:ring-purple-500 rounded-xl py-2.5 px-4 text-sm" value="{{ old('utm_medium') }}">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">UTM Campaign</label>
                        <input type="text" name="utm_campaign" placeholder="e.g. spring_sale" class="block w-full border-gray-200 dark:border-gray-700 dark:bg-[#1A1A22] dark:text-white focus:border-purple-500 focus:ring-purple-500 rounded-xl py-2.5 px-4 text-sm" value="{{ old('utm_campaign') }}">
                    </div>
                </div>
            </div>
            @endif

        </form>
    </div>

    <!-- Links Table -->
    <div class="bg-white dark:bg-[#121217] rounded-2xl border border-gray-100 dark:border-gray-800 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-800 flex justify-between items-center">
            <h3 class="text-base font-bold text-gray-900 dark:text-white">Your Links</h3>
            <span class="text-xs text-gray-500 dark:text-gray-400 bg-gray-100 dark:bg-gray-800 px-2.5 py-1 rounded-full">{{ $links->total() }} total</span>
        </div>

        @if($links->isEmpty())
        <div class="flex flex-col items-center justify-center py-20 text-center px-4">
            <div class="w-16 h-16 rounded-2xl bg-gray-100 dark:bg-gray-800 flex items-center justify-center text-gray-400 mb-4">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                </svg>
            </div>
            <h4 class="text-base font-bold text-gray-900 dark:text-white mb-1">No links yet</h4>
            <p class="text-sm text-gray-500 dark:text-gray-400">Create your first shortened link using the form above.</p>
        </div>
        @else
        <!-- Desktop Table -->
        <div class="hidden md:block overflow-x-auto">
            <table class="min-w-full">
                <thead>
                    <tr class="bg-gray-50 dark:bg-[#0D0D11] text-left">
                        <th class="px-4 py-3.5 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">#</th>
                        <th class="px-6 py-3.5 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Short Link</th>
                        <th class="px-6 py-3.5 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Destination</th>
                        <th class="px-6 py-3.5 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Clicks</th>
                        <th class="px-6 py-3.5 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3.5 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Created</th>
                        <th class="px-6 py-3.5 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                    @foreach($links as $link)
                    <tr class="hover:bg-gray-50 dark:hover:bg-[#1A1A22] transition-colors group">
                        <td class="px-4 py-4 whitespace-nowrap text-xs font-medium text-gray-500 dark:text-gray-400">
                            {{ ($links->currentPage() - 1) * $links->perPage() + $loop->iteration }}
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 rounded-lg bg-purple-100 dark:bg-purple-900/30 flex items-center justify-center text-purple-600 dark:text-purple-400 shrink-0">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                                    </svg>
                                </div>
                                <div>
                                    <a href="{{ route('redirect', $link->custom_slug ?? $link->short_code) }}" target="_blank" class="text-sm font-semibold text-gray-900 dark:text-white hover:text-purple-600 dark:hover:text-purple-400 block">
                                        {{ str_replace(['http://', 'https://'], '', config('app.url')) }}/{{ $link->custom_slug ?? $link->short_code }}
                                    </a>
                                    @if($link->use_redirect_page)
                                    <span class="text-[10px] text-indigo-500 bg-indigo-50 dark:bg-indigo-900/30 px-1.5 py-0.5 rounded font-medium">10s countdown</span>
                                    @endif
                                </div>
                                <button onclick="copyToClipboard('{{ url($link->custom_slug ?? $link->short_code) }}')" class="text-gray-300 dark:text-gray-600 hover:text-purple-500 dark:hover:text-purple-400 transition-colors opacity-0 group-hover:opacity-100">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" /></svg>
                                </button>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-sm text-gray-500 dark:text-gray-400 truncate max-w-[200px]" title="{{ $link->original_url }}">{{ $link->original_url }}</p>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-indigo-100 text-indigo-800 dark:bg-indigo-900/40 dark:text-indigo-300">
                                {{ number_format($link->clicks_count) }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            @if($link->expires_at && $link->expires_at->isPast())
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400">Expired</span>
                            @elseif($link->expires_at)
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-400">Expires {{ $link->expires_at->diffForHumans() }}</span>
                            @else
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400">Active</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-sm text-gray-500 dark:text-gray-400">{{ $link->created_at->format('M d, Y') }}</span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('links.edit', $link) }}" class="p-1.5 rounded-lg text-gray-400 hover:text-purple-600 dark:hover:text-purple-400 hover:bg-purple-50 dark:hover:bg-purple-900/20 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </a>
                                <form action="{{ route('links.destroy', $link) }}" method="POST" class="inline" onsubmit="return confirm('Delete this link?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="p-1.5 rounded-lg text-gray-400 hover:text-red-600 dark:hover:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Mobile cards -->
        <div class="block md:hidden divide-y divide-gray-100 dark:divide-gray-800">
            @foreach($links as $link)
            <div class="p-4">
                <div class="flex items-start justify-between gap-3 mb-2">
                    <div class="flex items-center gap-2 flex-1 min-w-0">
                        <div class="w-8 h-8 rounded-lg bg-purple-100 dark:bg-purple-900/30 flex items-center justify-center text-purple-600 dark:text-purple-400 shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                            </svg>
                        </div>
                        <div class="min-w-0">
                            <a href="{{ route('redirect', $link->custom_slug ?? $link->short_code) }}" target="_blank" class="text-sm font-semibold text-purple-600 dark:text-purple-400 block truncate">
                                {{ str_replace(['http://', 'https://'], '', config('app.url')) }}/{{ $link->custom_slug ?? $link->short_code }}
                            </a>
                            <p class="text-xs text-gray-500 dark:text-gray-500 truncate">{{ $link->original_url }}</p>
                        </div>
                    </div>
                    <span class="text-xs font-bold text-indigo-800 dark:text-indigo-300 bg-indigo-100 dark:bg-indigo-900/40 px-2 py-1 rounded-full shrink-0">{{ number_format($link->clicks_count) }} clicks</span>
                </div>
                <div class="flex items-center justify-between mt-3">
                    <span class="text-xs text-gray-500 dark:text-gray-400">{{ $link->created_at->format('M d, Y') }}</span>
                    <div class="flex items-center gap-3">
                        <button onclick="copyToClipboard('{{ url($link->custom_slug ?? $link->short_code) }}')" class="text-xs text-gray-500 hover:text-purple-600 dark:hover:text-purple-400">Copy</button>
                        <a href="{{ route('links.edit', $link) }}" class="text-xs text-purple-600 dark:text-purple-400">Edit</a>
                        <form action="{{ route('links.destroy', $link) }}" method="POST" class="inline" onsubmit="return confirm('Delete this link?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-xs text-red-500 hover:text-red-700">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="px-6 py-4 border-t border-gray-100 dark:border-gray-800">
            {{ $links->links() }}
        </div>
        @endif
    </div>

    <script>
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(function() {
                alert('Copied to clipboard!');
            });
        }
        document.querySelector("form").addEventListener("submit", function() {
            const checkbox = document.querySelector("input[name='use_redirect_page']");
            if (!checkbox.checked) {
                checkbox.value = 0;
            }
        });
    </script>
</x-app-layout>
