@extends('layouts.installer')

@section('content')
<div class="text-center mb-10">
    <div class="inline-flex items-center justify-center p-3 rounded-2xl bg-gradient-to-br from-indigo-500/20 to-blue-500/20 border border-indigo-500/30 mb-4">
        <svg class="w-8 h-8 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"></path>
        </svg>
    </div>
    <h2 class="text-2xl font-bold mb-2">Database Setup</h2>
    <p class="text-gray-400 text-sm">Below you should enter your database connection details. If you're not sure about these, contact your host.</p>
</div>

<form action="{{ route('install.database.setup') }}" method="POST" class="space-y-5">
    @csrf

    <div>
        <label for="db_host" class="block text-sm font-semibold text-gray-300 mb-1.5">Database Host</label>
        <input type="text" name="db_host" id="db_host" value="{{ old('db_host', '127.0.0.1') }}" required
            class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500/50 transition-all">
    </div>

    <div>
        <label for="db_port" class="block text-sm font-semibold text-gray-300 mb-1.5">Database Port</label>
        <input type="text" name="db_port" id="db_port" value="{{ old('db_port', '3306') }}" required
            class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500/50 transition-all">
    </div>

    <div>
        <label for="db_database" class="block text-sm font-semibold text-gray-300 mb-1.5">Database Name</label>
        <input type="text" name="db_database" id="db_database" value="{{ old('db_database', 'shortlink') }}" required placeholder="e.g., shortlink_db"
            class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500/50 transition-all">
    </div>

    <div>
        <label for="db_username" class="block text-sm font-semibold text-gray-300 mb-1.5">Database Username</label>
        <input type="text" name="db_username" id="db_username" value="{{ old('db_username', 'root') }}" required
            class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500/50 transition-all">
    </div>

    <div>
        <label for="db_password" class="block text-sm font-semibold text-gray-300 mb-1.5">Database Password</label>
        <input type="password" name="db_password" id="db_password" value="{{ old('db_password') }}"
            class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500/50 transition-all">
        <p class="mt-1 text-xs text-gray-500">Leave blank if no password.</p>
    </div>

    <div class="pt-4 flex justify-between items-center">
        <a href="{{ route('install.index') }}" class="text-gray-400 hover:text-white text-sm font-medium transition-colors">Back</a>
        
        <button type="submit" class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-gradient-to-r from-indigo-600 to-blue-600 hover:from-indigo-500 hover:to-blue-500 text-white text-sm font-semibold rounded-xl tracking-wide transition-all shadow-lg shadow-indigo-500/25">
            Connect Database &amp; Continue
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        </button>
    </div>
</form>
@endsection
