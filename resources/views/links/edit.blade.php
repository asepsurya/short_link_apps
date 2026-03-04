<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('links.index') }}" class="text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-300 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </a>
            <h2 class="text-xl font-bold text-gray-900 dark:text-white mt-1">Edit Link</h2>
        </div>
    </x-slot>

    @if($errors->any())
    <div class="mb-6 flex items-center gap-3 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 text-red-700 dark:text-red-400 px-4 py-3 rounded-xl">
        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
        <ul class="text-sm list-disc list-inside">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
    </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- LEFT: Edit Form (2/3 width on XL) -->
        <div class="lg:col-span-2 space-y-6">

            <!-- Short URL Display -->
            <div class="bg-white dark:bg-[#121217] rounded-2xl border border-gray-100 dark:border-gray-800 shadow-sm p-6">
                <h3 class="text-sm font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-3">Short URL</h3>
                <div class="flex items-center justify-between bg-gray-50 dark:bg-[#0D0D11] rounded-xl border border-gray-200 dark:border-gray-800 px-4 py-3">
                    <a href="{{ route('redirect', $link->custom_slug ?? $link->short_code) }}" target="_blank" class="text-purple-600 dark:text-purple-400 font-semibold hover:underline truncate">
                        {{ str_replace(['http://', 'https://'], '', config('app.url')) }}/{{ $link->custom_slug ?? $link->short_code }}
                    </a>
                    <button type="button" onclick="navigator.clipboard.writeText('{{ url($link->custom_slug ?? $link->short_code) }}'); this.textContent='Copied!'; setTimeout(()=>this.textContent='Copy',1500)" class="shrink-0 ml-3 text-xs font-semibold text-gray-500 dark:text-gray-400 hover:text-purple-600 dark:hover:text-purple-400 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg px-3 py-1.5 transition-colors">
                        Copy
                    </button>
                </div>
            </div>

            <!-- Main Edit Form -->
            <div class="bg-white dark:bg-[#121217] rounded-2xl border border-gray-100 dark:border-gray-800 shadow-sm p-6">
                <h3 class="text-base font-bold text-gray-900 dark:text-white flex items-center gap-2 mb-5">
                    <div class="w-7 h-7 rounded-lg bg-purple-100 dark:bg-purple-900/40 flex items-center justify-center text-purple-600 dark:text-purple-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                    </div>
                    Link Details
                </h3>

                <form action="{{ route('links.update', $link) }}" method="POST" class="space-y-5">
                    @csrf
                    @method('PUT')

                    <!-- Destination URL -->
                    <div>
                        <label for="original_url" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Destination URL <span class="text-red-500">*</span></label>
                        <input type="url" name="original_url" id="original_url" required class="block w-full border-gray-200 dark:border-gray-700 dark:bg-[#1A1A22] dark:text-white focus:border-purple-500 focus:ring-purple-500 rounded-xl py-2.5 px-4 text-sm transition-colors" value="{{ old('original_url', $link->original_url) }}">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Password -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                                Password Protection
                                @if($link->password)
                                <span class="text-xs text-yellow-600 dark:text-yellow-400 font-normal ml-1">(currently set)</span>
                                @endif
                            </label>
                            <input type="password" name="password" placeholder="Leave empty to keep current" class="block w-full border-gray-200 dark:border-gray-700 dark:bg-[#1A1A22] dark:text-white focus:border-purple-500 focus:ring-purple-500 rounded-xl py-2.5 px-4 text-sm transition-colors">
                            @if($link->password)
                            <label class="flex items-center gap-2 mt-2 cursor-pointer">
                                <input id="remove_password" name="remove_password" type="checkbox" value="1" class="rounded border-gray-300 text-red-600 shadow-sm focus:ring-red-500 dark:bg-gray-900 dark:border-gray-700">
                                <span class="text-xs text-red-600 dark:text-red-400">Remove password protection</span>
                            </label>
                            @endif
                        </div>

                        <!-- Expiration -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Expiration Date</label>
                            <input type="datetime-local" name="expires_at" class="block w-full border-gray-200 dark:border-gray-700 dark:bg-[#1A1A22] dark:text-white focus:border-purple-500 focus:ring-purple-500 rounded-xl py-2.5 px-4 text-sm transition-colors" value="{{ old('expires_at', $link->expires_at ? $link->expires_at->format('Y-m-d\TH:i') : '') }}">
                        </div>

                        <!-- Redirect Type -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Redirect Type</label>
                            <select name="redirect_type" class="block w-full border-gray-200 dark:border-gray-700 dark:bg-[#1A1A22] dark:text-white focus:border-purple-500 focus:ring-purple-500 rounded-xl py-2.5 px-4 text-sm transition-colors">
                                <option value="302" {{ $link->redirect_type == 302 ? 'selected' : '' }}>302 – Temporary (best for analytics)</option>
                                <option value="301" {{ $link->redirect_type == 301 ? 'selected' : '' }}>301 – Permanent (best for SEO)</option>
                            </select>
                        </div>
                    </div>

                    <!-- Redirect Page Toggle -->
                    <div class="flex items-center justify-between bg-purple-50 dark:bg-purple-900/10 border border-purple-100 dark:border-purple-900/40 rounded-xl px-4 py-3 mt-2">
                        <div>
                            <p class="text-sm font-semibold text-gray-900 dark:text-white">10‑second Redirect Page</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">Show a countdown interstitial before redirecting visitors.</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer ml-4 shrink-0">
                            <input type="checkbox" name="use_redirect_page" value="1" class="sr-only peer" {{ $link->use_redirect_page ? 'checked' : '' }}>
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-purple-300 dark:peer-focus:ring-purple-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-purple-600"></div>
                        </label>
                    </div>

                    <!-- Buttons -->
                    <div class="flex items-center justify-end gap-3 pt-2">
                        <a href="{{ route('links.index') }}" class="px-5 py-2.5 text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white border border-gray-200 dark:border-gray-700 rounded-xl transition-colors">
                            Cancel
                        </a>
                        <button type="submit" class="inline-flex items-center gap-2 py-2.5 px-6 rounded-xl bg-purple-600 text-white text-sm font-semibold hover:bg-purple-700 transition-colors shadow-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- RIGHT: Stats & QR Code (1/3 width on XL) -->
        <div class="space-y-6">

            <!-- Stats Card -->
            <div class="bg-white dark:bg-[#121217] rounded-2xl border border-gray-100 dark:border-gray-800 shadow-sm p-6">
                <h3 class="text-sm font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-4">Statistics</h3>
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-gray-50 dark:bg-[#0D0D11] rounded-xl p-4 text-center">
                        <p class="text-3xl font-extrabold text-gray-900 dark:text-white">{{ number_format($link->clicks_count) }}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1 font-medium uppercase tracking-wider">Total Clicks</p>
                    </div>
                    <div class="bg-gray-50 dark:bg-[#0D0D11] rounded-xl p-4 text-center">
                        @if($link->expires_at && $link->expires_at->isPast())
                        <p class="text-lg font-bold text-red-500">Expired</p>
                        @elseif($link->expires_at)
                        <p class="text-sm font-bold text-yellow-500">{{ $link->expires_at->diffForHumans() }}</p>
                        @else
                        <p class="text-lg font-bold text-green-500">Active</p>
                        @endif
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1 font-medium uppercase tracking-wider">Status</p>
                    </div>
                </div>
                <div class="mt-4 pt-4 border-t border-gray-100 dark:border-gray-800">
                    <p class="text-xs text-gray-500 dark:text-gray-500 font-medium">Created</p>
                    <p class="text-sm text-gray-900 dark:text-white mt-0.5">{{ $link->created_at->format('M d, Y \a\t h:i A') }}</p>
                </div>
            </div>

            <!-- QR Code Card -->
            <div class="bg-white dark:bg-[#121217] rounded-2xl border border-gray-100 dark:border-gray-800 shadow-sm p-6">
                <h3 class="text-sm font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-4">QR Code</h3>
                <div class="bg-white rounded-xl p-4 flex justify-center items-center shadow-inner border border-gray-100 dark:border-gray-800">
                    {!! SimpleSoftwareIO\QrCode\Facades\QrCode::size(200)->generate(url($link->custom_slug ?? $link->short_code)) !!}
                </div>
                <a href="data:image/svg+xml;base64,{{ base64_encode(SimpleSoftwareIO\QrCode\Facades\QrCode::size(400)->generate(url($link->custom_slug ?? $link->short_code))) }}" download="qrcode-{{ $link->short_code }}.svg" class="mt-4 flex items-center justify-center gap-2 w-full py-2.5 px-4 rounded-xl border border-gray-200 dark:border-gray-700 text-sm font-medium text-gray-700 dark:text-gray-300 hover:border-purple-400 dark:hover:border-purple-500 hover:text-purple-600 dark:hover:text-purple-400 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                    </svg>
                    Download QR Code (SVG)
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
