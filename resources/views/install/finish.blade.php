@extends('layouts.installer')

@section('content')
<div class="text-center mb-10">
    <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-gradient-to-br from-green-400 to-emerald-500 border-4 border-emerald-500/30 mb-6 shadow-lg shadow-emerald-500/40 relative overflow-hidden">
        <!-- Shine effect -->
        <div class="absolute inset-0 bg-white/20 w-1/2 -skew-x-12 translate-x-[-150%] animate-[shine_2s_infinite]"></div>
        <svg class="w-10 h-10 text-white relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
        </svg>
    </div>
    
    <h2 class="text-3xl font-extrabold mb-3 text-white">Installation Complete!</h2>
    <p class="text-gray-400 text-sm max-w-md mx-auto">ScrollWebLink has been successfully installed and configured. Your admin account is ready.</p>
</div>

<div class="bg-white/5 border border-white/10 rounded-2xl p-6 mb-8 text-center space-y-2">
    <p class="text-gray-300 text-sm">You are now logged in as the Super Administrator.</p>
    <p class="text-gray-300 text-sm">Please remember your email and password for future logins.</p>
</div>

<div class="flex justify-center">
    <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center justify-center gap-2 px-8 py-4 bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-500 hover:to-indigo-500 text-white font-bold rounded-2xl tracking-wide transition-all shadow-xl shadow-purple-500/30 hover:scale-105 active:scale-95">
        Go to Admin Dashboard
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
    </a>
</div>

<style>
    @keyframes shine {
        100% { transform: translateX(250%) skewX(-12deg); }
    }
</style>
@endsection
