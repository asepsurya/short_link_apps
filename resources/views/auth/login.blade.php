<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
 
    <div class="mb-8">
        <h2 class="text-[32px] font-bold text-gray-900 dark:text-white leading-tight mb-2 tracking-tight mt-6">Welcome back</h2>
        <p class="text-gray-500 dark:text-gray-400 text-[15px]">Welcome back! Please enter your details.</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block font-medium text-[14px] text-gray-800 dark:text-gray-200 mb-1.5">Email</label>
            <input id="email" class="block w-full border-gray-200 dark:border-gray-800 dark:bg-[#121217] dark:text-gray-200 focus:border-purple-500 focus:ring-purple-500 rounded-lg shadow-sm py-2.5 px-3 sm:text-sm transition-colors" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="hi@example.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block font-medium text-[14px] text-gray-800 dark:text-gray-200 mb-1.5">Password</label>
            <div class="relative">
                <input id="password" class="block w-full border-gray-200 dark:border-gray-800 dark:bg-[#121217] dark:text-gray-200 focus:border-purple-500 focus:ring-purple-500 rounded-lg shadow-sm py-2.5 px-3 sm:text-sm transition-colors" type="password" name="password" required autocomplete="current-password" placeholder="Enter password" />
                <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 focus:outline-none" onclick="document.getElementById('password').type = document.getElementById('password').type === 'password' ? 'text' : 'password'">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me & Forgot Password -->
        <div class="flex items-center justify-between pt-1">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-purple-600 shadow-sm focus:ring-purple-500 dark:bg-gray-900 dark:border-gray-700 dark:focus:ring-purple-600 dark:focus:ring-offset-gray-900" name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">Remember for 30 days</span>
            </label>

            @if (Route::has('password.request'))
            <a class="text-sm font-medium text-purple-600 hover:text-purple-700 dark:text-purple-400 dark:hover:text-purple-300" href="{{ route('password.request') }}">
                Forgot Password?
            </a>
            @endif
        </div>

        <div class="space-y-3 pt-3">
            @if(session('error'))
                <div class="mb-4 font-medium text-sm text-red-600 dark:text-red-400">
                    {{ session('error') }}
                </div>
            @endif
            <button class="w-full flex justify-center py-2.5 px-4 border border-transparent rounded-lg shadow-sm text-[15px] font-semibold text-white bg-[#6366F1] hover:bg-[#4F46E5] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                Login
            </button>

            <a href="{{ route('auth.google') }}" class="w-full flex justify-center items-center gap-2 py-2.5 px-4 border border-gray-300 dark:border-gray-700 rounded-lg shadow-sm text-[15px] font-semibold text-gray-700 dark:text-white bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition-colors">
                <svg class="h-4 w-4" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4" />
                    <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853" />
                    <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05" />
                    <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335" /></svg>
                Continue with Google
            </a>
        </div>

        <p class="mt-8 text-center text-sm text-gray-500 dark:text-gray-400">
            Don't have an account? <a href="{{ route('register') }}" class="font-semibold text-gray-900 dark:text-white hover:underline">Sign up for free</a>
        </p>
    </form>
</x-guest-layout>
