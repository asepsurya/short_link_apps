<aside id="sidebar" class=" w-64 bg-white dark:bg-[#121217] border-r border-gray-200 dark:border-gray-800 flex flex-col transition-transform duration-300 transform -translate-x-full lg:translate-x-0 fixed lg:relative z-30 h-full">

    <!-- Profile & Logo Area -->
    <div class="p-6 border-b border-gray-200 dark:border-gray-800">
        @php
            $appName = Cache::get('platform.app_name', config('app.name', 'ScrollWebLink'));
            $primaryColor = Cache::get('platform.primary_color', '#7c3aed');
            $hasLink = \Illuminate\Support\Str::contains($appName, 'Link');
            $beforeLink = $hasLink ? \Illuminate\Support\Str::beforeLast($appName, 'Link') : $appName;
        @endphp
        <a href="{{ route('dashboard') }}" class="flex items-center gap-2 text-xl font-bold text-gray-900 dark:text-white mb-8">
            @if(Cache::has('platform.logo_path'))
                <img src="{{ asset('storage/' . Cache::get('platform.logo_path')) }}" class="w-8 h-8 object-contain">
            @else
                <div class="w-8 h-8 rounded-lg flex items-center justify-center text-white" style="background: linear-gradient(135deg, {{ $primaryColor }}, #4f46e5)">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                    </svg>
                </div>
            @endif
            {{ $beforeLink }}<span style="color: {{ $primaryColor }}">{{ $hasLink ? 'Link' : '' }}</span>
        </a>


<div class="flex items-center gap-3">
    <div class="flex-shrink-0 w-10 h-10 rounded-full bg-purple-100 dark:bg-purple-900/30 flex items-center justify-center border-2 border-white dark:border-gray-800 text-purple-600 dark:text-purple-400 font-bold shadow-sm overflow-hidden">
        @if(Auth::user()->avatar_url)
            <img src="{{ Auth::user()->avatar_url }}" alt="{{ Auth::user()->name }}" class="w-full h-full object-cover">
        @else
            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
        @endif
    </div>
    <div class="truncate">
        <p class="text-[14px] font-semibold text-gray-900 dark:text-white truncate" title="{{ Auth::user()->name }}">
            Hi, {{ explode(' ', Auth::user()->name)[0] }}
        </p>
        <div class="flex items-center gap-1.5">
            <p class="text-[11px] text-gray-500 dark:text-gray-400 truncate max-w-[100px]" title="{{ Auth::user()->email }}">
                {{ Auth::user()->email }}
            </p>
            
        </div>
        @if(Auth::user()->role === 'admin')
            <span class="px-1.5 py-0.5 text-[10px] font-bold uppercase tracking-wider text-purple-700 bg-purple-100 rounded dark:bg-purple-900/40 dark:text-purple-400">
                Admin
            </span>
        @endif
    </div>
</div>

    </div>

    <!-- Navigation Links -->
    <nav class="flex-1 p-4 space-y-1.5 overflow-y-auto  sidebar-scroll">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors w-full justify-start {{ request()->routeIs('dashboard') ? 'bg-purple-50 text-purple-700 dark:bg-purple-600/10 dark:text-purple-400' : 'text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-800/50 dark:hover:text-gray-100' }}">
            <svg class="w-5 h-5 {{ request()->routeIs('dashboard') ? 'text-purple-600 dark:text-purple-400' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
            </svg>
            Dashboard
        </a>

        <a href="{{ route('links.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors w-full justify-start {{ request()->routeIs('links.index') ? 'bg-purple-50 text-purple-700 dark:bg-purple-600/10 dark:text-purple-400' : 'text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-800/50 dark:hover:text-gray-100' }}">
            <svg class="w-5 h-5 {{ request()->routeIs('links.index') ? 'text-purple-600 dark:text-purple-400' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
            </svg>
            My Links
        </a>

        @if(Auth::user()->role === 'admin')
        <div class="pt-4 pb-1">
            <p class="px-3 text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-wider">Admin</p>
        </div>

        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors w-full justify-start {{ request()->routeIs('admin.dashboard') ? 'bg-purple-50 text-purple-700 dark:bg-purple-600/10 dark:text-purple-400' : 'text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-800/50 dark:hover:text-gray-100' }}">
            <svg class="w-5 h-5 {{ request()->routeIs('admin.dashboard') ? 'text-purple-600 dark:text-purple-400' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
            </svg>
            Overview
        </a>

        <a href="{{ route('admin.users') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors w-full justify-start {{ request()->routeIs('admin.users') ? 'bg-purple-50 text-purple-700 dark:bg-purple-600/10 dark:text-purple-400' : 'text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-800/50 dark:hover:text-gray-100' }}">
            <svg class="w-5 h-5 {{ request()->routeIs('admin.users') ? 'text-purple-600 dark:text-purple-400' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
            </svg>
            Users
        </a>

        <a href="{{ route('admin.settings') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors w-full justify-start {{ request()->routeIs('admin.settings') ? 'bg-purple-50 text-purple-700 dark:bg-purple-600/10 dark:text-purple-400' : 'text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-800/50 dark:hover:text-gray-100' }}">
            <svg class="w-5 h-5 {{ request()->routeIs('admin.settings') ? 'text-purple-600 dark:text-purple-400' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
            </svg>
            App Settings
        </a>
        @endif
    </nav>

    <!-- Bottom Actions -->
    <div class="p-4 border-t border-gray-200 dark:border-gray-800">

        <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors w-full   focus:outline-none">
            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
            </svg>
            Profile
        </a>
        <!-- Logout Button -->
        <form method="POST" action="{{ route('logout') }}" class="mt-2">
            @csrf
            <button type="submit" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors w-full text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20 hover:text-red-600 dark:hover:text-red-400 focus:outline-none">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                </svg>
                Log Out
            </button>
        </form>
    </div>
</aside>

<!-- Mobile Overlay -->
<div id="sidebar-overlay" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-20 hidden lg:hidden" onclick="document.getElementById('sidebar').classList.add('-translate-x-full'); this.classList.add('hidden')"></div>

<!-- Mobile Sidebar toggle script logic -->
<script>
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebar-overlay');

    const observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            if (mutation.attributeName === "class") {
                const isHidden = sidebar.classList.contains('-translate-x-full');
                if (!isHidden) {
                    overlay.classList.remove('hidden');
                } else {
                    overlay.classList.add('hidden');
                }
            }
        });
    });
    observer.observe(sidebar, {
        attributes: true
    });

</script>
