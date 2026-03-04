<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Link;
use App\Models\LinkClick;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $totalLinks = $user->links()->count();
        $totalClicks = $user->links()->sum('clicks_count');

        // Recent links
        $recentLinks = $user->links()->latest()->take(5)->get();

        // Clicks over last 7 days chart
        $clicksPerDay = LinkClick::whereHas('link', function ($q) use ($user) {
            $q->where('user_id', $user->id);
        })
            ->where('created_at', '>=', Carbon::now()->subDays(6)->startOfDay())
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->keyBy('date');

        $chartDates = [];
        $chartClicks = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->format('Y-m-d');
            $chartDates[] = Carbon::now()->subDays($i)->format('M d');
            $chartClicks[] = isset($clicksPerDay[$date]) ? $clicksPerDay[$date]->count : 0;
        }

        // Top countries
        $topCountries = LinkClick::whereHas('link', function ($q) use ($user) {
            $q->where('user_id', $user->id);
        })
            ->whereNotNull('country')
            ->select('country', DB::raw('count(*) as count'))
            ->groupBy('country')
            ->orderByDesc('count')
            ->take(5)
            ->get();

        // Devices
        $devices = LinkClick::whereHas('link', function ($q) use ($user) {
            $q->where('user_id', $user->id);
        })
            ->whereNotNull('device_type')
            ->select('device_type', DB::raw('count(*) as count'))
            ->groupBy('device_type')
            ->get();

        return view('dashboard', compact('totalLinks', 'totalClicks', 'recentLinks', 'chartDates', 'chartClicks', 'topCountries', 'devices'));
    }
}
