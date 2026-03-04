<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Protected Link - ScrollWebLink</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased text-gray-900 bg-gray-100 dark:bg-gray-900 flex items-center justify-center min-h-screen">
    <div class="w-full max-w-md mx-auto p-6">
        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden border border-gray-200 dark:border-gray-700">
            <div class="p-8 text-center">
                <svg class="mx-auto h-12 w-12 text-indigo-500 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Protected Link</h2>
                <p class="text-sm text-gray-500 dark:text-gray-400 mb-6">
                    This shortened URL is protected by a password. Please enter it below to proceed to the destination.
                </p>

                <form method="POST" action="{{ route('links.unlock', $link) }}">
                    @csrf

                    <div class="mb-4 text-left">
                        <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 sr-only">Password</label>
                        <input id="password" type="password" name="password" required autofocus placeholder="Enter password..." class="appearance-none block w-full px-3 py-3 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-700 dark:text-white">

                        @error('password')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                        Unlock Link
                    </button>

                    <p class="mt-4 text-xs text-gray-400 text-center">
                        Powered by <a href="/" class="hover:text-indigo-400">ScrollWebLink</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
