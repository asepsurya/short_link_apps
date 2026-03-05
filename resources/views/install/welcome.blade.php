@extends('layouts.installer')

@section('content')
<div class="text-center mb-10">
    <div class="inline-flex items-center justify-center p-3 rounded-2xl bg-gradient-to-br from-purple-500/20 to-indigo-500/20 border border-purple-500/30 mb-4">
        <svg class="w-8 h-8 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
        </svg>
    </div>
    <h2 class="text-2xl font-bold mb-2">Welcome to Setup</h2>
    <p class="text-gray-400 text-sm">We'll help you configure your ShortLink system in minutes. First, let's check if your server meets the requirements.</p>
</div>

<div class="space-y-3 mb-8">
    @foreach ($requirements as $name => $passed)
        <div class="flex items-center justify-between p-4 rounded-xl {{ $passed ? 'bg-white/5 border border-white/10' : 'bg-red-500/10 border border-red-500/30' }}">
            <span class="text-sm font-medium {{ $passed ? 'text-gray-200' : 'text-red-400' }}">{{ $name }}</span>
            @if($passed)
                <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            @else
                <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            @endif
        </div>
    @endforeach
</div>

@if($allPassed)
    <div class="flex justify-end">
        <a href="{{ route('install.database') }}" class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-500 hover:to-indigo-500 text-white text-sm font-semibold rounded-xl tracking-wide transition-all shadow-lg shadow-purple-500/25">
            Continue to Database
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        </a>
    </div>
@else
    <div class="p-4 rounded-xl bg-orange-500/10 border border-orange-500/20 text-orange-400 text-sm text-center">
        Please resolve the missing requirements above before continuing.
    </div>
@endif
@endsection
