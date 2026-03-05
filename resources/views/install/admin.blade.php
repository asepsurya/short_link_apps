@extends('layouts.installer')

@section('content')
<div class="text-center mb-10">
    <div class="inline-flex items-center justify-center p-3 rounded-2xl bg-gradient-to-br from-green-500/20 to-emerald-500/20 border border-green-500/30 mb-4">
        <svg class="w-8 h-8 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
        </svg>
    </div>
    <h2 class="text-2xl font-bold mb-2">Create Admin Account</h2>
    <p class="text-gray-400 text-sm">Database connection successful! Now, let's create the first administrator account to access the dashboard.</p>
</div>

<form action="{{ route('install.admin.setup') }}" method="POST" class="space-y-5">
    @csrf

    <div>
        <label for="name" class="block text-sm font-semibold text-gray-300 mb-1.5">Full Name</label>
        <input type="text" name="name" id="name" value="{{ old('name') }}" required placeholder="e.g., John Doe"
            class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-emerald-500/50 focus:border-emerald-500/50 transition-all">
    </div>

    <div>
        <label for="email" class="block text-sm font-semibold text-gray-300 mb-1.5">Email Address</label>
        <input type="email" name="email" id="email" value="{{ old('email') }}" required placeholder="e.g., admin@example.com"
            class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-emerald-500/50 focus:border-emerald-500/50 transition-all">
    </div>

    <div>
        <label for="password" class="block text-sm font-semibold text-gray-300 mb-1.5">Password</label>
        <input type="password" name="password" id="password" required placeholder="Minimum 8 characters"
            class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-emerald-500/50 focus:border-emerald-500/50 transition-all">
    </div>

    <div>
        <label for="password_confirmation" class="block text-sm font-semibold text-gray-300 mb-1.5">Confirm Password</label>
        <input type="password" name="password_confirmation" id="password_confirmation" required placeholder="Re-enter password"
            class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-emerald-500/50 focus:border-emerald-500/50 transition-all">
    </div>

    <div class="pt-4 flex justify-between items-center">
        <!-- Optional: Admin creation shouldn't really go back since migrations ran, better to disable back button logically or just not rendering back link here -->
        <span></span>
        
        <button type="submit" class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-gradient-to-r from-emerald-600 to-green-600 hover:from-emerald-500 hover:to-green-500 text-white text-sm font-semibold rounded-xl tracking-wide transition-all shadow-lg shadow-emerald-500/25">
            Create Admin &amp; Finish
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        </button>
    </div>
</form>
@endsection
