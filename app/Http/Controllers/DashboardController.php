<?php

namespace App\Http\Controllers;

use App\Models\TimeLog;
use App\Models\UserDetail;
use App\Models\VehicleInformation;
use App\Models\Visitor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    public function dashboardAnalytics()
    {
        $pageConfigs = ['pageHeader' => false];

        return view('content.dashboard.dashboard-analytics', ['pageConfigs' => $pageConfigs]);
    }
    public function dashboard()
    {

        $todayVisit = TimeLog::whereBetween('entry_time', [Carbon::now()->startOfDay(), Carbon::now()->endOfDay()])->count();
        $yesterdayVisits = TimeLog::whereBetween('entry_time', [Carbon::yesterday()->startOfDay(), Carbon::yesterday()->endOfDay()])->count();
        $totalWeekVisit = TimeLog::whereBetween('entry_time', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
        $totalLastWeekVisit = TimeLog::whereBetween('entry_time', [Carbon::now()->subWeek(1), Carbon::now()->startOfWeek()])->count();
        $totalVehicleVisit = VehicleInformation::whereBetween('updated_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
        $totalLastVehicleVisit = VehicleInformation::whereBetween('updated_at', [Carbon::now()->subWeek(1), Carbon::now()->startOfWeek()])->count();
        $totalLastWeekVisit = TimeLog::whereBetween('entry_time', [Carbon::now()->subWeek(1), Carbon::now()->startOfWeek()])->count();
        $totalMaleLastWeek = UserDetail::where('gender', 'male')->whereBetween('updated_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
        $totalFemaleLastWeek = UserDetail::where('gender', 'female')->whereBetween('updated_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
        $weekStartDate = Carbon::now()->startOfWeek();
        $weekEndDate = Carbon::now()->endOfWeek();

        $drivein = DB::table('visitors')->where('type', '=', 'DriveIn')
            ->join('time_logs', 'visitors.time_log_id', '=', 'time_logs.id')
            ->whereBetween('entry_time', [$weekStartDate, $weekEndDate])
            ->orWhereBetween('exit_time', [$weekStartDate, $weekEndDate])
            ->count();
        $sms = DB::table('visitors')->where('type', '=', 'SMS')
            ->join('time_logs', 'visitors.time_log_id', '=', 'time_logs.id')
            ->whereBetween('entry_time', [$weekStartDate, $weekEndDate])
            ->orWhereBetween('exit_time', [$weekStartDate, $weekEndDate])
            ->count();
        $walkin = DB::table('visitors')->where('type', '=', 'WalkIn')
            ->join('time_logs', 'visitors.time_log_id', '=', 'time_logs.id')
            ->whereBetween('entry_time', [$weekStartDate, $weekEndDate])
            ->orWhereBetween('exit_time', [$weekStartDate, $weekEndDate])
            ->count();
        $ipass = DB::table('visitors')->where('type', '=', 'iPass')
            ->join('time_logs', 'visitors.time_log_id', '=', 'time_logs.id')
            ->whereBetween('entry_time', [$weekStartDate, $weekEndDate])
            ->orWhereBetween('exit_time', [$weekStartDate, $weekEndDate])
            ->count();
        $id = DB::table('visitors')->where('type', '=', 'ID')
            ->join('time_logs', 'visitors.time_log_id', '=', 'time_logs.id')
            ->whereBetween('entry_time', [$weekStartDate, $weekEndDate])
            ->orWhereBetween('exit_time', [$weekStartDate, $weekEndDate])
            ->count();
        $today = Carbon::today();
        $maleCount = DB::table('visitors')
            ->join('time_logs', 'visitors.time_log_id', '=', 'time_logs.id')
            ->join('user_details', 'visitors.user_detail_id', '=', 'user_details.id')
            ->where('user_details.gender', '=', 'female')
            ->whereDate('time_logs.entry_time', '=', $today)
            ->count();
        $femaleCount = DB::table('visitors')
            ->join('time_logs', 'visitors.time_log_id', '=', 'time_logs.id')
            ->join('user_details', 'visitors.user_detail_id', '=', 'user_details.id')
            ->where('user_details.gender', '=', 'female')
            ->whereDate('time_logs.entry_time', '=', $today)
            ->count();
        $totalCount = $maleCount + $femaleCount;
        if ($totalCount > 0) {
            $percentage_male = ($maleCount / $totalCount) * 100;
            $percentage_female  = ($femaleCount / $totalCount) * 100;
        } else {
            $percentage_male = 0;
            $percentage_female  = 0;
        }

        $femaleMonthlyVisitorCount = DB::table('visitors')
            ->join('time_logs', 'visitors.time_log_id', '=', 'time_logs.id')
            ->join('user_details', 'visitors.user_detail_id', '=', 'user_details.id')
            ->where('user_details.gender', '=', 'Female')
            ->whereMonth('time_logs.entry_time', Carbon::now()->month)
            ->count();
        $maleMonthlyVisitorCount = DB::table('visitors')
            ->join('time_logs', 'visitors.time_log_id', '=', 'time_logs.id')
            ->join('user_details', 'visitors.user_detail_id', '=', 'user_details.id')
            ->where('user_details.gender', '=', 'Male')
            ->whereMonth('time_logs.entry_time', Carbon::now()->month)
            ->count();

        $BarChart = UserDetail::select(
            DB::raw("MONTH(updated_at) as month"),
            DB::raw("YEAR(updated_at) as year"),
            DB::raw("COUNT(*) as count"),
            DB::raw("gender")
        )
            ->groupBy('year', 'month', 'gender')
            ->get();

        $maleData = [];
        $femaleData = [];

        foreach ($BarChart as $mdata) {
            if ($mdata->gender == 'male') {
                $maleData[] = $mdata->count;
                $femaleData[] = 0;
            } else {
                $femaleData[] = $mdata->count;
                $maleData[] = 0;
            }
        }

        $labels = $BarChart->map(function ($item) {
            return date("M Y", strtotime($item->year . '-' . $item->month . '-01'));
        });

        $mdata = [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Male',
                    'backgroundColor' => '#007bff',
                    'data' => $maleData,
                ],
                [
                    'label' => 'Female',
                    'backgroundColor' => '#fd6b37',
                    'data' => $femaleData,
                ]
            ]
        ];
        $monthlyData = DB::table('user_details')
            ->selectRaw('COUNT(*) as count, FLOOR(DATEDIFF(NOW(), date_of_birth)/365.25) - 18 as age')
            ->whereRaw('date_of_birth IS NOT NULL')
            ->whereRaw('created_at >= DATE_SUB(NOW(), INTERVAL 10 YEAR)')
            ->groupBy('age')
            ->orderBy('age')
            ->get();

        $labels = $monthlyData->pluck('age');
        $data = $monthlyData->pluck('count');

        $chartData = [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Visits',
                    'backgroundColor' => [
                        '#007bff',
                        '#dc3545',
                        '#ffc107',
                        '#28a745',
                        '#17a2b8',
                        '#6c757d',
                    ],
                    'data' => $data,
                ]
            ]
        ];
        $vlabels = Visitor::whereYear('created_at', date('Y'))->select(DB::raw("MONTH(created_at) as month_name"))->get();
        $vdata = Visitor::whereYear('created_at', date('Y'))->select(DB::raw("COUNT(*) as count"))->get();
        // $users = Visitor::select(DB::raw("COUNT(*) as count"), DB::raw("MONTH(created_at) as month_name"))
        //     ->whereYear('created_at', date('Y'))
        //     ->orderBy('id', 'ASC')
        //     ->pluck('count', 'month_name');

        // $vlabels = $users->keys();
        // $vdata = $users->values();

        // $yearlyData = UserDetail::select(DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as count'))
        //     ->whereYear('created_at', Carbon::now()->year)
        //     ->get()
        //     ->toArray();

        $yearlyMonth = UserDetail::whereYear('created_at', Carbon::now()->year)->select(DB::raw('MONTH(created_at) as month'))->get();
        $yearlyCount = UserDetail::whereYear('created_at', Carbon::now()->year)->select(DB::raw('COUNT(*) as count'))->get();
        // $yearlyData = UserDetail::whereYear('created_at', Carbon::now()->year)->select(DB::raw('COUNT(*) as count'))->get();

        $data = [
            'labels' => [],
            'data' => []
        ];

        for ($i = 1; $i <= 12; $i++) {
            $monthData = array_values(array_filter($yearlyMonth, function ($item) use ($i) {
                return $item['month'] == $i;
            }));
            $count = array_values(array_filter($yearlyCount, function ($item) use ($i) {
                return $item['month'] == $i;
            }));

            if (!empty($monthData)) {
                $data['data'][] = $count[0]['count'];
            } else {
                $data['data'][] = 0;
            }

            $data['labels'][] = date('F', mktime(0, 0, 0, $i, 1));
        }

        $yearlyData = json_encode($data);

        $chart = DB::table('visitors')
            ->join('user_details', 'visitors.user_detail_id', '=', 'user_details.id')
            ->join('time_logs', 'visitors.time_log_id', '=', 'time_logs.id')
            ->select(DB::raw('COUNT(*) as total'), DB::raw('FLOOR(DATEDIFF(CURRENT_DATE, user_details.date_of_birth) / 365.25 / 10) * 10 + 18 AS age'))
            ->whereBetween('time_logs.entry_time', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])
            ->groupBy(DB::raw('FLOOR(DATEDIFF(CURRENT_DATE, user_details.date_of_birth) / 365.25 / 10) * 10 + 18'))
            ->orderBy('age')
            ->get()
            ->toArray();

        $labels = [];
        $datachart = [];
        foreach ($chart as $item) {
            $labelschart[] = $item->age . ' - ' . ($item->age + 9);
            $datachart[] = $item->total;
        }

        $totalVisitors = DB::table('visitors')->count();
        return view(
            'dashboard',
            [
                'totalVisitorsToday' => $todayVisit,
                'yesterdayVisitor' => $yesterdayVisits,
                'totalThisWeek' => $totalWeekVisit,
                'totalLastWeekVisit' => $totalLastWeekVisit,
                'totalVehicleWeek' => $totalVehicleVisit,
                'totalLastVehicleVisit' => $totalLastVehicleVisit,
                'totalMaleLastWeek' => $totalMaleLastWeek,
                'totalFemaleLastWeek' => $totalFemaleLastWeek,
                'BarChart' => json_encode($mdata),
                'femaleCount' => $femaleCount,
                'maleCount' => $maleCount,
                'totalVisitors' => $totalVisitors,
                'chartData' => $chartData,
                'vlabels' => $vlabels,
                'vdata' => $vdata,
                'walkin' => $walkin,
                'drivein' => $drivein,
                'ipass' => $ipass,
                'id' => $id,
                'sms' => $sms,
                'yearlyData' => $yearlyData,
                'percentage_male' => $percentage_male,
                'percentage_female' => $percentage_female,
                'maleMonthlyVisitorCount' => $maleMonthlyVisitorCount,
                'femaleMonthlyVisitorCount' => $femaleMonthlyVisitorCount,
                'labelschart' => $labelschart,
                'datachart' => $datachart
            ]
        );
    }

    // Dashboard - Ecommerce
    public function dashboardEcommerce()
    {
        $pageConfigs = ['pageHeader' => false];

        return view('content.dashboard.dashboard-ecommerce', ['pageConfigs' => $pageConfigs]);
    }
}
