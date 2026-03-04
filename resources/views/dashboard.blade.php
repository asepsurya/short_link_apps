<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold text-gray-900 dark:text-white mt-1">
            Overview
        </h2>
    </x-slot>

    <!-- Welcome Section -->
    <div class="mb-8 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white flex items-center gap-2">
                Welcome back, {{ explode(' ', Auth::user()->name)[0] }} 👋
            </h1>
            <p class="text-gray-500 dark:text-gray-400 text-sm mt-1">Here's what's happening with your links today.</p>
        </div>

        <x-primary-button tag="a" href="{{ route('links.index') }}" class="gap-2 shrink-0 bg-purple-600 hover:bg-purple-700 focus:bg-purple-700 active:bg-purple-800">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Create New Link
        </x-primary-button>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Links -->
        <div class="bg-white dark:bg-[#121217] rounded-2xl p-6 border border-gray-100 dark:border-gray-800 shadow-sm relative overflow-hidden group">
            <div class="absolute -right-6 -top-6 w-24 h-24 bg-purple-500/10 rounded-full blur-xl group-hover:bg-purple-500/20 transition-colors"></div>
            <div class="flex justify-between items-start mb-4">
                <div class="w-10 h-10 rounded-xl bg-purple-100 dark:bg-purple-900/40 flex items-center justify-center text-purple-600 dark:text-purple-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                    </svg>
                </div>
                <span class="text-xs font-medium {{ $linksGrowth >= 0 ? 'text-green-500 bg-green-500/10' : 'text-red-500 bg-red-500/10' }} px-2 py-1 rounded flex items-center gap-1">
                    <svg class="w-3 h-3 {{ $linksGrowth < 0 ? 'rotate-180' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                    </svg>
                    {{ number_format(abs($linksGrowth), 1) }}%
                </span>
            </div>
            <div>
                <p class="text-sm text-gray-500 dark:text-gray-400 font-medium mb-1">Total Links</p>
                <h3 class="text-3xl font-bold text-gray-900 dark:text-white">{{ $totalLinks }}</h3>
            </div>
        </div>

        <!-- Total Clicks -->
        <div class="bg-white dark:bg-[#121217] rounded-2xl p-6 border border-gray-100 dark:border-gray-800 shadow-sm relative overflow-hidden group">
            <div class="absolute -right-6 -top-6 w-24 h-24 bg-indigo-500/10 rounded-full blur-xl group-hover:bg-indigo-500/20 transition-colors"></div>
            <div class="flex justify-between items-start mb-4">
                <div class="w-10 h-10 rounded-xl bg-indigo-100 dark:bg-indigo-900/40 flex items-center justify-center text-indigo-600 dark:text-indigo-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                </div>
                <span class="text-xs font-medium {{ $clicksGrowth >= 0 ? 'text-green-500 bg-green-500/10' : 'text-red-500 bg-red-500/10' }} px-2 py-1 rounded flex items-center gap-1">
                    <svg class="w-3 h-3 {{ $clicksGrowth < 0 ? 'rotate-180' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                    </svg>
                    {{ number_format(abs($clicksGrowth), 1) }}%
                </span>
            </div>
            <div>
                <p class="text-sm text-gray-500 dark:text-gray-400 font-medium mb-1">Total Clicks</p>
                <h3 class="text-3xl font-bold text-gray-900 dark:text-white">{{ number_format($totalClicks) }}</h3>
            </div>
        </div>

        <!-- Unique Visitors (Mocked for dashboard feel) -->
        <div class="bg-white dark:bg-[#121217] rounded-2xl p-6 border border-gray-100 dark:border-gray-800 shadow-sm relative overflow-hidden group">
            <div class="absolute -right-6 -top-6 w-24 h-24 bg-blue-500/10 rounded-full blur-xl group-hover:bg-blue-500/20 transition-colors"></div>
            <div class="flex justify-between items-start mb-4">
                <div class="w-10 h-10 rounded-xl bg-blue-100 dark:bg-blue-900/40 flex items-center justify-center text-blue-600 dark:text-blue-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
            </div>
            <div>
                <p class="text-sm text-gray-500 dark:text-gray-400 font-medium mb-1">Avg. CTR</p>
                <h3 class="text-3xl font-bold text-gray-900 dark:text-white">{{ number_format($avgCtr * 100, 1) }}%</h3>
            </div>
        </div>

    </div>

    <!-- Main Content Area Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Chart Section -->
        <div class="lg:col-span-2 bg-white dark:bg-[#121217] rounded-2xl p-6 border border-gray-100 dark:border-gray-800 shadow-sm">
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white">Click Analytics</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Your link performance over the last 7 days</p>
                </div>
                <select class="bg-gray-50 dark:bg-[#1A1A22] border border-gray-200 dark:border-gray-700 text-gray-900 dark:text-gray-300 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block p-2">
                    <option>Last 7 days</option>
                    <option>Last 30 days</option>
                    <option>This Year</option>
                </select>
            </div>
            <div class="h-72 w-full">
                <canvas id="clicksChart"></canvas>
            </div>
        </div>

        <!-- Recent Links List -->
        <div class="bg-white dark:bg-[#121217] rounded-2xl p-6 border border-gray-100 dark:border-gray-800 shadow-sm flex flex-col">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white">Recent Top Links</h3>
                <a href="{{ route('links.index') }}" class="text-sm text-purple-600 hover:text-purple-700 dark:text-purple-400 dark:hover:text-purple-300 font-medium">View all</a>
            </div>

            <div class="space-y-4 flex-1 overflow-y-auto pr-2">
                @forelse($recentLinks ?? [] as $link)
                <div class="flex items-center justify-between p-3 rounded-xl hover:bg-gray-50 dark:hover:bg-[#1A1A22] transition-colors border border-transparent dark:hover:border-gray-800 group">
                    <div class="flex items-center gap-3 overflow-hidden">
                        <div class="w-10 h-10 rounded-lg bg-gray-100 dark:bg-gray-800 flex items-center justify-center text-gray-500 dark:text-gray-400 shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                            </svg>
                        </div>
                        <div class="truncate">
                            <a href="{{ url($link->short_code) }}" target="_blank" class="text-sm font-semibold text-gray-900 dark:text-white hover:text-purple-600 dark:hover:text-purple-400 truncate block">{{ str_replace(['http://', 'https://'], '', config('app.url')) }}/{{ $link->short_code }}</a>
                            <p class="text-xs text-gray-500 dark:text-gray-500 truncate">{{ $link->original_url }}</p>
                        </div>
                    </div>
                    <div class="text-right shrink-0 ml-2">
                        <div class="text-sm font-bold text-gray-900 dark:text-white">{{ number_format($link->clicks_count) }}</div>
                        <div class="text-[10px] text-gray-500 uppercase tracking-wider">Clicks</div>
                    </div>
                </div>
                @empty
                <div class="text-center py-8">
                    <div class="w-16 h-16 rounded-full bg-gray-100 dark:bg-gray-800 flex items-center justify-center mx-auto mb-3">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                        </svg>
                    </div>
                    <p class="text-gray-500 dark:text-gray-400 text-sm">No links found yet.</p>
                    <a href="{{ route('links.index') }}" class="mt-2 inline-block text-sm text-purple-600 dark:text-purple-400 font-medium">Create your first link</a>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('clicksChart').getContext('2d');

            // Get dark mode status for chart colors
            const isDark = document.documentElement.classList.contains('dark');
            const gridColor = isDark ? '#1f2937' : '#f3f4f6';
            const tickColor = isDark ? '#9ca3af' : '#6b7280';

            // Create gradient for the line chart
            const gradient = ctx.createLinearGradient(0, 0, 0, 400);
            gradient.addColorStop(0, 'rgba(124, 58, 237, 0.4)'); // Purple 600
            gradient.addColorStop(1, 'rgba(124, 58, 237, 0)');

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: {!! json_encode($chartDates) !!},
                    datasets: [{
                        label: 'Clicks',
                        data: {!! json_encode($chartClicks) !!},
                        borderColor: '#7C3AED',
                        backgroundColor: gradient,
                        borderWidth: 2,
                        pointBackgroundColor: '#ffffff',
                        pointBorderColor: '#7C3AED',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6,
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: isDark ? '#1f2937' : '#ffffff',
                            titleColor: isDark ? '#f3f4f6' : '#111827',
                            bodyColor: isDark ? '#d1d5db' : '#4b5563',
                            borderColor: isDark ? '#374151' : '#e5e7eb',
                            borderWidth: 1,
                            padding: 10,
                            displayColors: false,
                            callbacks: {
                                label: function(context) {
                                    return context.parsed.y + ' clicks';
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: gridColor,
                                borderDash: [5, 5]
                            },
                            ticks: {
                                color: tickColor,
                                maxTicksLimit: 5
                            },
                            border: {
                                display: false
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                color: tickColor
                            },
                            border: {
                                display: false
                            }
                        }
                    },
                    interaction: {
                        intersect: false,
                        mode: 'index'
                    }
                }
            });
        });

    </script>
</x-app-layout>
