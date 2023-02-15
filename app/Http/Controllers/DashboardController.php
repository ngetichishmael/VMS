<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    // Dashboard - Analytics
    public function dashboardAnalytics()
    {
        $pageConfigs = ['pageHeader' => false];

        return view('content.dashboard.dashboard-analytics', ['pageConfigs' => $pageConfigs]);
    }
    public function dashboard()
    {
        $today = [Carbon::now()->startOfDay(), Carbon::now()->endOfDay()];
        $oneWeekAgo = [Carbon::now()->subWeek(1), Carbon::now()->startOfWeek()];
        $totalVisitorsToday = Visitor::whereHas('visitorsVisits', function($query) use ($today) {
            $query->whereBetween('entry_time', $today);
        })->count();
        $totalVisitorsWeek = Visitor::whereHas('visitorsVisits', function($query) use ($oneWeekAgo) {
            $query->whereBetween('entry_time', $oneWeekAgo);
        })->count();

        return view('dashboard', ['totalVisitorsToday' => $totalVisitorsToday, 'totalVisitorsWeekly'=>$totalVisitorsWeek]);
    }

    // Dashboard - Ecommerce
    public function dashboardEcommerce()
    {
        $pageConfigs = ['pageHeader' => false];

        return view('content.dashboard.dashboard-ecommerce', ['pageConfigs' => $pageConfigs]);
    }
}
