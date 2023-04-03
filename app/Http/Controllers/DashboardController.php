<?php

namespace App\Http\Controllers;

use App\Models\TimeLog;


use App\Models\Unit;
use App\Models\UserCode;
use App\Models\UserDetail;
use App\Models\ValidToken;
use App\Models\VehicleInformation;
use App\Models\Visitor;
use Carbon\Carbon;
use DateInterval;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Nette\Utils\DateTime;

class DashboardController extends Controller
{

    public function dashboardAnalytics()
    {
        $pageConfigs = ['pageHeader' => false];

        return view('content.dashboard.dashboard-analytics', ['pageConfigs' => $pageConfigs]);
    }
    public function OTP()
    {
        $pageConfigs = ['blankPage' => true];

        return view('otp', ['pageConfigs' => $pageConfigs]);
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

        $driveinThisWeek = DB::table('visitors')->where('type', '=', 'DriveIn')
            ->join('time_logs', 'visitors.time_log_id', '=', 'time_logs.id')
            ->whereBetween('entry_time', [$weekStartDate, $weekEndDate])
            ->orWhereBetween('exit_time', [$weekStartDate, $weekEndDate])
            ->count();
        $driveinLastWeek = DB::table('visitors')
            ->where('type', '=', 'DriveIn')
            ->join('time_logs', 'visitors.time_log_id', '=', 'time_logs.id')
            ->whereBetween('entry_time', [Carbon::now()->startOfWeek()->subWeek(), Carbon::now()->endOfWeek()->subWeek()])
            ->orWhereBetween('exit_time', [Carbon::now()->startOfWeek()->subWeek(), Carbon::now()->endOfWeek()->subWeek()])
            ->count();

        $smsThisWeek = DB::table('visitors')->where('type', '=', 'SMS')
            ->join('time_logs', 'visitors.time_log_id', '=', 'time_logs.id')
            ->whereBetween('entry_time', [$weekStartDate, $weekEndDate])
            ->orWhereBetween('exit_time', [$weekStartDate, $weekEndDate])
            ->count();
        $smsLastWeek = DB::table('visitors')
            ->where('type', '=', 'SMS')
            ->join('time_logs', 'visitors.time_log_id', '=', 'time_logs.id')
            ->whereBetween('entry_time', [Carbon::now()->startOfWeek()->subWeek(), Carbon::now()->endOfWeek()->subWeek()])
            ->orWhereBetween('exit_time', [Carbon::now()->startOfWeek()->subWeek(), Carbon::now()->endOfWeek()->subWeek()])
            ->count();
        $walkinThisWeek = DB::table('visitors')->where('type', '=', 'WalkIn')
            ->join('time_logs', 'visitors.time_log_id', '=', 'time_logs.id')
            ->whereBetween('entry_time', [$weekStartDate, $weekEndDate])
            ->orWhereBetween('exit_time', [$weekStartDate, $weekEndDate])
            ->count();
        $walkinLastWeek = DB::table('visitors')
            ->where('type', '=', 'WalkIn')
            ->join('time_logs', 'visitors.time_log_id', '=', 'time_logs.id')
            ->whereBetween('entry_time', [Carbon::now()->startOfWeek()->subWeek(), Carbon::now()->endOfWeek()->subWeek()])
            ->orWhereBetween('exit_time', [Carbon::now()->startOfWeek()->subWeek(), Carbon::now()->endOfWeek()->subWeek()])
            ->count();
        $ipassThisWeek = DB::table('visitors')->where('type', '=', 'iPass')
            ->join('time_logs', 'visitors.time_log_id', '=', 'time_logs.id')
            ->whereBetween('entry_time', [$weekStartDate, $weekEndDate])
            ->orWhereBetween('exit_time', [$weekStartDate, $weekEndDate])
            ->count();
        $ipassLastWeek = DB::table('visitors')
            ->where('type', '=', 'iPass')
            ->join('time_logs', 'visitors.time_log_id', '=', 'time_logs.id')
            ->whereBetween('entry_time', [Carbon::now()->startOfWeek()->subWeek(), Carbon::now()->endOfWeek()->subWeek()])
            ->orWhereBetween('exit_time', [Carbon::now()->startOfWeek()->subWeek(), Carbon::now()->endOfWeek()->subWeek()])
            ->count();

        $idThisWeek = DB::table('visitors')->where('type', '=', 'ID')
            ->join('time_logs', 'visitors.time_log_id', '=', 'time_logs.id')
            ->whereBetween('entry_time', [$weekStartDate, $weekEndDate])
            ->orWhereBetween('exit_time', [$weekStartDate, $weekEndDate])
            ->count();
        $idLastWeek = DB::table('visitors')
            ->where('type', '=', 'ID')
            ->join('time_logs', 'visitors.time_log_id', '=', 'time_logs.id')
            ->whereBetween('entry_time', [Carbon::now()->startOfWeek()->subWeek(), Carbon::now()->endOfWeek()->subWeek()])
            ->orWhereBetween('exit_time', [Carbon::now()->startOfWeek()->subWeek(), Carbon::now()->endOfWeek()->subWeek()])
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
            DB::raw("MONTH(user_details.updated_at) as month"),
            DB::raw("YEAR(user_details.updated_at) as year"),
            DB::raw("COUNT(*) as count"),
            DB::raw("user_details.gender")
        )
            ->join('visitors', 'user_details.id', '=', 'visitors.user_detail_id')
            ->join('time_logs', 'visitors.time_log_id', '=', 'time_logs.id')
            ->whereRaw("time_logs.entry_time >= DATE_SUB(CURRENT_DATE, INTERVAL 2 MONTH)")
            ->groupBy('year', 'month', 'user_details.gender')
            ->get();

        $maleDatabar = [];
        $femaleDatabar = [];

        $monthsbar = [];

        for ($i = 2; $i >= 0; $i--) {
            $month = date('m', strtotime("-$i month")); // get the month number
            $year = date('Y', strtotime("-$i month")); // get the year
            $monthsbar[] = date("M Y", strtotime($year . '-' . $month . '-01')); // format the date as "M Y"
            $maleCount = $BarChart->where('gender', 'male')->where('month', $month)->where('year', $year)->sum('count');
            $femaleCount = $BarChart->where('gender', 'female')->where('month', $month)->where('year', $year)->sum('count');
            $maleData[] = $maleCount;
            $femaleData[] = $femaleCount;
        }

        $labelsbar = collect($monthsbar);

        $mdata = [
            'labels' => $labelsbar,
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
            ->whereRaw('created_at >= DATE_SUB(NOW(), INTERVAL 7 YEAR)')
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
        $vlabels = TimeLog::whereYear('entry_time', date('Y'))
            ->select(DB::raw("MONTH(entry_time) as month_name"))->get();

        $vdata = TimeLog::whereYear('entry_time', date('Y'))
            ->select(DB::raw("COUNT(*) as count"))->get();

        $yearlyMonth = TimeLog::whereYear('entry_time', Carbon::now()->year)
            ->select(DB::raw('MONTH(entry_time) as month'))->get()->toArray();
        $yearlyCount = TimeLog::whereYear('entry_time', Carbon::now()->year)
            ->select(DB::raw('COUNT(*) as count'))->get()->toArray();
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
                return $item['count'] == $i;
            }));
            if (!empty($monthData)) {
                $data['data'][] = $monthData[0]['month'];
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
        $units = Unit::select('units.id', 'units.name', DB::raw('COUNT(*) as visitors_count'))
            ->join('residents', 'residents.unit_id', '=', 'units.id')
            ->join('visitors', 'visitors.resident_id', '=', 'residents.id')
            ->join('time_logs', 'time_logs.id', '=', 'visitors.time_log_id')
            ->whereMonth('time_logs.entry_time', '=', now()->month)
            ->groupBy('units.id', 'units.name')
            ->orderByDesc('visitors_count')
            ->take(5)
            ->get();
        $organizations = DB::table('organizations')
            ->select('organizations.name', DB::raw('COUNT(visitors.id) as visitor_count'))
            ->join('premises', 'organizations.code', '=', 'premises.organization_code')
            ->join('blocks', 'premises.id', '=', 'blocks.premise_id')
            ->join('units', 'blocks.id', '=', 'units.block_id')
            ->join('residents', 'units.id', '=', 'residents.unit_id')
            ->join('visitors', 'residents.id', '=', 'visitors.resident_id')
            ->join('time_logs', 'visitors.time_log_id', '=', 'time_logs.id')
            ->whereMonth('time_logs.entry_time', Carbon::now()->month)
            ->groupBy('organizations.name')
            ->orderByDesc('visitor_count')
            ->limit(5)
            ->get();

//        $organizations = DB::table('organizations')
//            ->select('organizations.name', DB::raw('COUNT(visitors.id) as visitor_count'))
//            ->join('premises', 'organizations.code', '=', 'premises.organization_code')
//            ->join('blocks', 'premises.id', '=', 'blocks.premise_id')
//            ->join('units', 'blocks.id', '=', 'units.block_id')
//            ->join('residents', 'units.id', '=', 'residents.unit_id')
//            ->join('visitors', 'residents.id', '=', 'visitors.resident_id')
//            ->join('time_logs', 'visitors.time_log_id', '=', 'time_logs.id')
//            ->whereMonth('time_logs.entry_time', Carbon::now()->month)
//            ->groupBy('organizations.name')
//            ->orderByDesc('visitor_count')
//            ->take(5)
//            ->get();

        $visitorsData = DB::table('visitors')
            ->select(DB::raw('DATE(visitors.created_at) as date'), DB::raw('COUNT(*) as count'))
            ->whereRaw('YEAR(visitors.created_at) = YEAR(CURRENT_DATE)')
            ->groupBy('date')
            ->orderBy('date')
            ->get();
        $dates = $visitorsData->pluck('date')->toArray();
        $visitorCounts = $visitorsData->pluck('count')->toArray();

        $chartDataL = [
            'labels' => $dates,
            'datasets' => [
                [
                    'label' => 'Visitors',
                    'fill' => true,
                    'backgroundColor' => 'rgba(39, 128, 243,0.2)',
                    'borderColor' => 'rgba(39, 128, 243,1)',
                    'borderWidth' => 2,
                    'pointRadius' => 1,
                    'pointBackgroundColor' => 'rgba(39, 128, 243,1)',
                    'pointBorderColor' => '#D16E38',
                    'pointHoverRadius' => 5,
                    'pointHoverBackgroundColor' => 'rgba(39, 128, 243,1)',
                    'pointHoverBorderColor' => 'rgba(208, 111, 57,1)',
                    'data' => $visitorCounts,
                ]
            ]
        ];

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
                'walkinThisWeek' => $walkinThisWeek,
                'walkinLastWeek' => $walkinLastWeek,
                'driveinLastWeek' => $driveinLastWeek,
                'driveinThisWeek' => $driveinThisWeek,
                'ipassLastWeek' => $ipassLastWeek,
                'ipassThisWeek' => $ipassThisWeek,
                'idThisWeek' => $idThisWeek,
                'idLastWeek' => $idLastWeek,
                'smsThisWeek' => $smsThisWeek,
                'smsLastWeek' => $smsLastWeek,
                'yearlyData' => $yearlyData,
                'maleMonthlyVisitorCount' => $maleMonthlyVisitorCount,
                'femaleMonthlyVisitorCount' => $femaleMonthlyVisitorCount,
                'labelschart' => $labelschart,
                'datachart' => $datachart,
                'units' => $units,
                'organizations' => $organizations,
                'chartDataL' => $chartDataL,
            ]
        );
    }

    //organization staff
    public function staffdashboard()
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

        $driveinThisWeek = DB::table('visitors')->where('type', '=', 'DriveIn')
            ->join('time_logs', 'visitors.time_log_id', '=', 'time_logs.id')
            ->whereBetween('entry_time', [$weekStartDate, $weekEndDate])
            ->orWhereBetween('exit_time', [$weekStartDate, $weekEndDate])
            ->count();
        $driveinLastWeek = DB::table('visitors')
            ->where('type', '=', 'DriveIn')
            ->join('time_logs', 'visitors.time_log_id', '=', 'time_logs.id')
            ->whereBetween('entry_time', [Carbon::now()->startOfWeek()->subWeek(), Carbon::now()->endOfWeek()->subWeek()])
            ->orWhereBetween('exit_time', [Carbon::now()->startOfWeek()->subWeek(), Carbon::now()->endOfWeek()->subWeek()])
            ->count();

        $smsThisWeek = DB::table('visitors')->where('type', '=', 'SMS')
            ->join('time_logs', 'visitors.time_log_id', '=', 'time_logs.id')
            ->whereBetween('entry_time', [$weekStartDate, $weekEndDate])
            ->orWhereBetween('exit_time', [$weekStartDate, $weekEndDate])
            ->count();
        $smsLastWeek = DB::table('visitors')
            ->where('type', '=', 'SMS')
            ->join('time_logs', 'visitors.time_log_id', '=', 'time_logs.id')
            ->whereBetween('entry_time', [Carbon::now()->startOfWeek()->subWeek(), Carbon::now()->endOfWeek()->subWeek()])
            ->orWhereBetween('exit_time', [Carbon::now()->startOfWeek()->subWeek(), Carbon::now()->endOfWeek()->subWeek()])
            ->count();
        $walkinThisWeek = DB::table('visitors')->where('type', '=', 'WalkIn')
            ->join('time_logs', 'visitors.time_log_id', '=', 'time_logs.id')
            ->whereBetween('entry_time', [$weekStartDate, $weekEndDate])
            ->orWhereBetween('exit_time', [$weekStartDate, $weekEndDate])
            ->count();
        $walkinLastWeek = DB::table('visitors')
            ->where('type', '=', 'WalkIn')
            ->join('time_logs', 'visitors.time_log_id', '=', 'time_logs.id')
            ->whereBetween('entry_time', [Carbon::now()->startOfWeek()->subWeek(), Carbon::now()->endOfWeek()->subWeek()])
            ->orWhereBetween('exit_time', [Carbon::now()->startOfWeek()->subWeek(), Carbon::now()->endOfWeek()->subWeek()])
            ->count();
        $ipassThisWeek = DB::table('visitors')->where('type', '=', 'iPass')
            ->join('time_logs', 'visitors.time_log_id', '=', 'time_logs.id')
            ->whereBetween('entry_time', [$weekStartDate, $weekEndDate])
            ->orWhereBetween('exit_time', [$weekStartDate, $weekEndDate])
            ->count();
        $ipassLastWeek = DB::table('visitors')
            ->where('type', '=', 'iPass')
            ->join('time_logs', 'visitors.time_log_id', '=', 'time_logs.id')
            ->whereBetween('entry_time', [Carbon::now()->startOfWeek()->subWeek(), Carbon::now()->endOfWeek()->subWeek()])
            ->orWhereBetween('exit_time', [Carbon::now()->startOfWeek()->subWeek(), Carbon::now()->endOfWeek()->subWeek()])
            ->count();

        $idThisWeek = DB::table('visitors')->where('type', '=', 'ID')
            ->join('time_logs', 'visitors.time_log_id', '=', 'time_logs.id')
            ->whereBetween('entry_time', [$weekStartDate, $weekEndDate])
            ->orWhereBetween('exit_time', [$weekStartDate, $weekEndDate])
            ->count();
        $idLastWeek = DB::table('visitors')
            ->where('type', '=', 'ID')
            ->join('time_logs', 'visitors.time_log_id', '=', 'time_logs.id')
            ->whereBetween('entry_time', [Carbon::now()->startOfWeek()->subWeek(), Carbon::now()->endOfWeek()->subWeek()])
            ->orWhereBetween('exit_time', [Carbon::now()->startOfWeek()->subWeek(), Carbon::now()->endOfWeek()->subWeek()])
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
            DB::raw("MONTH(user_details.updated_at) as month"),
            DB::raw("YEAR(user_details.updated_at) as year"),
            DB::raw("COUNT(*) as count"),
            DB::raw("user_details.gender")
        )
            ->join('visitors', 'user_details.id', '=', 'visitors.user_detail_id')
            ->join('time_logs', 'visitors.time_log_id', '=', 'time_logs.id')
            ->whereRaw("time_logs.entry_time >= DATE_SUB(CURRENT_DATE, INTERVAL 2 MONTH)")
            ->groupBy('year', 'month', 'user_details.gender')
            ->get();

        $maleDatabar = [];
        $femaleDatabar = [];

        $monthsbar = [];

        for ($i = 2; $i >= 0; $i--) {
            $month = date('m', strtotime("-$i month")); // get the month number
            $year = date('Y', strtotime("-$i month")); // get the year
            $monthsbar[] = date("M Y", strtotime($year . '-' . $month . '-01')); // format the date as "M Y"
            $maleCount = $BarChart->where('gender', 'male')->where('month', $month)->where('year', $year)->sum('count');
            $femaleCount = $BarChart->where('gender', 'female')->where('month', $month)->where('year', $year)->sum('count');
            $maleData[] = $maleCount;
            $femaleData[] = $femaleCount;
        }

        $labelsbar = collect($monthsbar);

        $mdata = [
            'labels' => $labelsbar,
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
            ->whereRaw('created_at >= DATE_SUB(NOW(), INTERVAL 7 YEAR)')
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
        $vlabels = TimeLog::whereYear('entry_time', date('Y'))
            ->select(DB::raw("MONTH(entry_time) as month_name"))->get();

        $vdata = TimeLog::whereYear('entry_time', date('Y'))
            ->select(DB::raw("COUNT(*) as count"))->get();

        $yearlyMonth = TimeLog::whereYear('entry_time', Carbon::now()->year)
            ->select(DB::raw('MONTH(entry_time) as month'))->get()->toArray();
        $yearlyCount = TimeLog::whereYear('entry_time', Carbon::now()->year)
            ->select(DB::raw('COUNT(*) as count'))->get()->toArray();
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
                return $item['count'] == $i;
            }));
            if (!empty($monthData)) {
                $data['data'][] = $monthData[0]['month'];
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
        $units = Unit::select('units.id', 'units.name', DB::raw('COUNT(*) as visitors_count'))
            ->join('residents', 'residents.unit_id', '=', 'units.id')
            ->join('visitors', 'visitors.resident_id', '=', 'residents.id')
            ->join('time_logs', 'time_logs.id', '=', 'visitors.time_log_id')
            ->whereMonth('time_logs.entry_time', '=', now()->month)
            ->groupBy('units.id', 'units.name')
            ->orderByDesc('visitors_count')
            ->take(5)
            ->get();
        $organizations = DB::table('organizations')
            ->select('organizations.name', DB::raw('COUNT(visitors.id) as visitor_count'))
            ->join('premises', 'organizations.code', '=', 'premises.organization_code')
            ->join('blocks', 'premises.id', '=', 'blocks.premise_id')
            ->join('units', 'blocks.id', '=', 'units.block_id')
            ->join('residents', 'units.id', '=', 'residents.unit_id')
            ->join('visitors', 'residents.id', '=', 'visitors.resident_id')
            ->join('time_logs', 'visitors.time_log_id', '=', 'time_logs.id')
            ->whereMonth('time_logs.entry_time', Carbon::now()->month)
            ->groupBy('organizations.name')
            ->orderByDesc('visitor_count')
            ->limit(5)
            ->get();

        $visitorsData = DB::table('visitors')
            ->select(DB::raw('DATE(visitors.created_at) as date'), DB::raw('COUNT(*) as count'))
            ->whereRaw('YEAR(visitors.created_at) = YEAR(CURRENT_DATE)')
            ->groupBy('date')
            ->orderBy('date')
            ->get();
        $dates = $visitorsData->pluck('date')->toArray();
        $visitorCounts = $visitorsData->pluck('count')->toArray();

        $chartDataL = [
            'labels' => $dates,
            'datasets' => [
                [
                    'label' => 'Visitors',
                    'fill' => true,
                    'backgroundColor' => 'rgba(39, 128, 243,0.2)',
                    'borderColor' => 'rgba(39, 128, 243,1)',
                    'borderWidth' => 2,
                    'pointRadius' => 1,
                    'pointBackgroundColor' => 'rgba(39, 128, 243,1)',
                    'pointBorderColor' => '#D16E38',
                    'pointHoverRadius' => 5,
                    'pointHoverBackgroundColor' => 'rgba(39, 128, 243,1)',
                    'pointHoverBorderColor' => 'rgba(208, 111, 57,1)',
                    'data' => $visitorCounts,
                ]
            ]
        ];

        return view(
            'organization_dashboard',
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
                'walkinThisWeek' => $walkinThisWeek,
                'walkinLastWeek' => $walkinLastWeek,
                'driveinLastWeek' => $driveinLastWeek,
                'driveinThisWeek' => $driveinThisWeek,
                'ipassLastWeek' => $ipassLastWeek,
                'ipassThisWeek' => $ipassThisWeek,
                'idThisWeek' => $idThisWeek,
                'idLastWeek' => $idLastWeek,
                'smsThisWeek' => $smsThisWeek,
                'smsLastWeek' => $smsLastWeek,
                'yearlyData' => $yearlyData,
                'maleMonthlyVisitorCount' => $maleMonthlyVisitorCount,
                'femaleMonthlyVisitorCount' => $femaleMonthlyVisitorCount,
                'labelschart' => $labelschart,
                'datachart' => $datachart,
                'units' => $units,
                'organizations' => $organizations,
                'chartDataL' => $chartDataL,
            ]
        );
    }

    // Dashboard - Ecommerce
    public function dashboardEcommerce()
    {
        $pageConfigs = ['pageHeader' => false];

        return view('content.dashboard.dashboard-ecommerce', ['pageConfigs' => $pageConfigs]);
    }
    public function store(Request $request)
    {
        $exists = UserCode::where('user_id', $request->user()->id)
            ->where('code', $request->otp)
            ->where('updated_at', '>=', now()->subMinutes(10))
            ->latest('updated_at')
            ->exists();
        if ($exists) {
            ValidToken::updateOrcreate(
                [
                    'user_id' => $request->user()->id,
                ],
                [
                    'phone_number' => $request->user()->phone_number,
                    'is_valid_otp' => 1
                ]
            );
            return redirect()->to('/dashboard');
        }
        try {
            throw ValidationException::withMessages([
                'otp' => "Invalid OTP",
            ]);
        } catch (ValidationException $e) {
            dd($e->getMessage());
        }
    }
}
