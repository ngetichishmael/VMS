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
use Illuminate\Support\Facades\Auth;
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
        $user = Auth::user();
        $userAccountType = $user->role_id;
        if ($userAccountType === 1) {
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
                $percentage_female = ($femaleCount / $totalCount) * 100;
            } else {
                $percentage_male = 0;
                $percentage_female = 0;
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

            for ($i = 5; $i >= 0; $i--) {
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

        } elseif ($userAccountType == 2) {
            $organization_code = Auth::user()->organization_code;
            return $this->staffdashboard($organization_code);
        }
    }

    //organization staff
    public function staffdashboard($organization_code)
    {

        $OtodayVisit = TimeLog::whereBetween('entry_time', [Carbon::now()->startOfDay(), Carbon::now()->endOfDay()])->whereHas('visitor.resident.unit.block.premise.organization', function ($query) use ($organization_code) {
            $query->where('code', $organization_code);
        })->count();
        $OyesterdayVisits = TimeLog::whereBetween('entry_time', [Carbon::yesterday()->startOfDay(), Carbon::yesterday()->endOfDay()])
            ->whereHas('visitor.resident.unit.block.premise.organization', function ($query) use ($organization_code) {
                $query->where('code', $organization_code);
            })->count();
        $OtotalWeekVisit = TimeLog::whereBetween('entry_time', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->whereHas('visitor.resident.unit.block.premise.organization', function ($query) use ($organization_code) {
                $query->where('code', $organization_code);
            })->count();
        $OtotalLastWeekVisit = TimeLog::whereBetween('entry_time', [Carbon::now()->subWeek(1), Carbon::now()->startOfWeek()])
            ->whereHas('visitor.resident.unit.block.premise.organization', function ($query) use ($organization_code) {
                $query->where('code', $organization_code);
            })->count();
        $OtotalVehicleVisit = VehicleInformation::whereBetween('updated_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->whereHas('visitor.resident.unit.block.premise.organization', function ($query) use ($organization_code) {
                $query->where('code', $organization_code);
            })->count();
        $OtotalLastVehicleVisit = VehicleInformation::whereBetween('updated_at', [Carbon::now()->subWeek(1), Carbon::now()->startOfWeek()])
            ->whereHas('visitor.resident.unit.block.premise.organization', function ($query) use ($organization_code) {
                $query->where('code', $organization_code);
            })->count();
        $OtotalLastWeekVisit = TimeLog::whereBetween('entry_time', [Carbon::now()->subWeek(1), Carbon::now()->startOfWeek()])
            ->whereHas('visitor.resident.unit.block.premise.organization', function ($query) use ($organization_code) {
                $query->where('code', $organization_code);
            })->count();
        $OtotalMaleLastWeek = UserDetail::join('visitors', 'user_details.id', '=', 'visitors.user_detail_id')
            ->join('residents', 'visitors.resident_id', '=', 'residents.id')
            ->join('units', 'residents.unit_id', '=', 'units.id')
            ->join('blocks', 'units.block_id', '=', 'blocks.id')
            ->join('premises', 'blocks.premise_id', '=', 'premises.id')
            ->join('organizations', 'premises.organization_code', '=', 'organizations.code')
            ->where('organizations.code', $organization_code)
            ->where('user_details.gender', 'male')
            ->whereBetween('user_details.updated_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->count();
        $OtotalFemaleLastWeek = UserDetail::join('visitors', 'user_details.id', '=', 'visitors.user_detail_id')
            ->join('residents', 'visitors.resident_id', '=', 'residents.id')
            ->join('units', 'residents.unit_id', '=', 'units.id')
            ->join('blocks', 'units.block_id', '=', 'blocks.id')
            ->join('premises', 'blocks.premise_id', '=', 'premises.id')
            ->join('organizations', 'premises.organization_code', '=', 'organizations.code')
            ->where('organizations.code', $organization_code)
            ->where('user_details.gender', 'female')
            ->whereBetween('user_details.updated_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->count();
//        $totalFemaleLastWeek = UserDetail::where('gender', 'female')->whereBetween('updated_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
        $weekStartDate = Carbon::now()->startOfWeek();
        $weekEndDate = Carbon::now()->endOfWeek();

        $OdriveinThisWeek = Visitor::where('type', '=', 'DriveIn')
            ->whereHas('timeLogs', function ($query) use ($weekStartDate, $weekEndDate) {
                $query->whereBetween('entry_time', [$weekStartDate, $weekEndDate]);
            })
            ->whereHas('resident.unit.block.premise.organization', function ($query) {
                $query->where('code', Auth::user()->organization_code);
            })->count();
        $OdriveinLastWeek = DB::table('visitors')
            ->where('type', '=', 'DriveIn')
            ->join('time_logs', 'visitors.time_log_id', '=', 'time_logs.id')
            ->join('residents', 'visitors.resident_id', '=', 'residents.id')
            ->join('units', 'residents.unit_id', '=', 'units.id')
            ->join('blocks', 'units.block_id', '=', 'blocks.id')
            ->join('premises', 'blocks.premise_id', '=', 'premises.id')
            ->join('organizations', 'premises.organization_code', '=', 'organizations.code')
            ->where('organizations.code', $organization_code)
            ->whereBetween('entry_time', [Carbon::now()->startOfWeek()->subWeek(), Carbon::now()->endOfWeek()->subWeek()])
            ->count();
        $OsmsThisWeek = DB::table('visitors')
            ->join('time_logs', 'visitors.time_log_id', '=', 'time_logs.id')
            ->join('residents', 'visitors.resident_id', '=', 'residents.id')
            ->join('units', 'residents.unit_id', '=', 'units.id')
            ->join('blocks', 'units.block_id', '=', 'blocks.id')
            ->join('premises', 'blocks.premise_id', '=', 'premises.id')
            ->join('organizations', 'premises.organization_code', '=', 'organizations.code')
            ->where('visitors.type', '=', 'SMS')
            ->whereBetween('time_logs.entry_time', [$weekStartDate, $weekEndDate])
            ->orWhereBetween('time_logs.exit_time', [$weekStartDate, $weekEndDate])
            ->where('organizations.code', '=', $organization_code)
            ->count();
        $OsmsLastWeek = DB::table('visitors')
            ->join('time_logs', 'visitors.time_log_id', '=', 'time_logs.id')
            ->join('residents', 'visitors.resident_id', '=', 'residents.id')
            ->join('units', 'residents.unit_id', '=', 'units.id')
            ->join('blocks', 'units.block_id', '=', 'blocks.id')
            ->join('premises', 'blocks.premise_id', '=', 'premises.id')
            ->join('organizations', 'premises.organization_code', '=', 'organizations.code')
            ->where('organizations.code', $organization_code)
            ->where('visitors.type', '=', 'SMS')
            ->where(function($query) {
                $query->whereBetween('entry_time', [Carbon::now()->startOfWeek()->subWeek(), Carbon::now()->endOfWeek()->subWeek()]);
            })
            ->count();
        $OwalkinThisWeek = DB::table('visitors')
            ->join('time_logs', 'visitors.time_log_id', '=', 'time_logs.id')
            ->join('residents', 'visitors.resident_id', '=', 'residents.id')
            ->join('units', 'residents.unit_id', '=', 'units.id')
            ->join('blocks', 'units.block_id', '=', 'blocks.id')
            ->join('premises', 'blocks.premise_id', '=', 'premises.id')
            ->join('organizations', 'premises.organization_code', '=', 'organizations.code')
            ->where('visitors.type', '=', 'WalkIn')
            ->where('organizations.code', '=', $organization_code)
            ->whereBetween('entry_time', [$weekStartDate, $weekEndDate])
            ->count();
        $OwalkinLastWeek = DB::table('visitors')
            ->select('visitors.*')
            ->join('time_logs', 'visitors.time_log_id', '=', 'time_logs.id')
            ->join('residents', 'visitors.resident_id', '=', 'residents.id')
            ->join('units', 'residents.unit_id', '=', 'units.id')
            ->join('blocks', 'units.block_id', '=', 'blocks.id')
            ->join('premises', 'blocks.premise_id', '=', 'premises.id')
            ->join('organizations', 'premises.organization_code', '=', 'organizations.code')
            ->where('type', '=', 'WalkIn')
            ->where('organizations.code', '=', $organization_code)
            ->whereBetween('entry_time', [Carbon::now()->startOfWeek()->subWeek(), Carbon::now()->endOfWeek()->subWeek()])
            ->count();
        $OipassThisWeek = DB::table('visitors')
            ->join('time_logs', 'visitors.time_log_id', '=', 'time_logs.id')
            ->join('residents', 'visitors.resident_id', '=', 'residents.id')
            ->join('units', 'residents.unit_id', '=', 'units.id')
            ->join('blocks', 'units.block_id', '=', 'blocks.id')
            ->join('premises', 'blocks.premise_id', '=', 'premises.id')
            ->join('organizations', 'premises.organization_code', '=', 'organizations.code')
            ->where('visitors.type', '=', 'iPass')
            ->whereBetween('time_logs.entry_time', [$weekStartDate, $weekEndDate])
            ->where('organizations.code', '=', $organization_code)
            ->count();
        $OipassLastWeek = DB::table('visitors')
            ->where('type', '=', 'iPass')
            ->join('time_logs', 'visitors.time_log_id', '=', 'time_logs.id')
            ->join('residents', 'visitors.resident_id', '=', 'residents.id')
            ->join('units', 'residents.unit_id', '=', 'units.id')
            ->join('blocks', 'units.block_id', '=', 'blocks.id')
            ->join('premises', 'blocks.premise_id', '=', 'premises.id')
            ->join('organizations', 'premises.organization_code', '=', 'organizations.code')
            ->where('organizations.code', '=', $organization_code)
            ->whereBetween('entry_time', [Carbon::now()->startOfWeek()->subWeek(), Carbon::now()->endOfWeek()->subWeek()])
            ->count();

        $OidThisWeek = DB::table('visitors')
            ->join('time_logs', 'visitors.time_log_id', '=', 'time_logs.id')
            ->join('residents', 'visitors.resident_id', '=', 'residents.id')
            ->join('units', 'residents.unit_id', '=', 'units.id')
            ->join('blocks', 'units.block_id', '=', 'blocks.id')
            ->join('premises', 'blocks.premise_id', '=', 'premises.id')
            ->join('organizations', 'premises.organization_code', '=', 'organizations.code')
            ->where('visitors.type', '=', 'ID')
            ->where('organizations.code', '=', $organization_code)
            ->whereBetween('entry_time', [$weekStartDate, $weekEndDate])
            ->count();

        $OidLastWeek = DB::table('visitors')
            ->where('type', '=', 'ID')
            ->join('time_logs', 'visitors.time_log_id', '=', 'time_logs.id')
            ->join('residents', 'visitors.resident_id', '=', 'residents.id')
            ->join('units', 'residents.unit_id', '=', 'units.id')
            ->join('blocks', 'units.block_id', '=', 'blocks.id')
            ->join('premises', 'blocks.premise_id', '=', 'premises.id')
            ->join('organizations', 'premises.organization_code', '=', 'organizations.code')
            ->where('organizations.code', '=', $organization_code)
            ->whereBetween('entry_time', [Carbon::now()->startOfWeek()->subWeek(), Carbon::now()->endOfWeek()->subWeek()])
            ->count();

        $today = Carbon::today();
        $OmaleCount = DB::table('visitors')
            ->join('time_logs', 'visitors.time_log_id', '=', 'time_logs.id')
            ->join('user_details', 'visitors.user_detail_id', '=', 'user_details.id')
            ->join('residents', 'visitors.resident_id', '=', 'residents.id')
            ->join('units', 'residents.unit_id', '=', 'units.id')
            ->join('blocks', 'units.block_id', '=', 'blocks.id')
            ->join('premises', 'blocks.premise_id', '=', 'premises.id')
            ->join('organizations', 'premises.organization_code', '=', 'organizations.code')
            ->where('organizations.code', '=', $organization_code)
            ->where('user_details.gender', '=', 'male')
            ->whereDate('time_logs.entry_time', '=', $today)
            ->count();
        $OfemaleCount = DB::table('visitors')
            ->join('time_logs', 'visitors.time_log_id', '=', 'time_logs.id')
            ->join('user_details', 'visitors.user_detail_id', '=', 'user_details.id')
            ->join('residents', 'visitors.resident_id', '=', 'residents.id')
            ->join('units', 'residents.unit_id', '=', 'units.id')
            ->join('blocks', 'units.block_id', '=', 'blocks.id')
            ->join('premises', 'blocks.premise_id', '=', 'premises.id')
            ->join('organizations', 'premises.organization_code', '=', 'organizations.code')
            ->where('organizations.code', $organization_code)
            ->where('user_details.gender', '=', 'female')
            ->whereDate('time_logs.entry_time', '=', $today)
            ->count();
        $totalCount = $OmaleCount + $OfemaleCount;
        if ($totalCount > 0) {
            $percentage_male = ($OmaleCount / $totalCount) * 100;
            $percentage_female  = ($OfemaleCount / $totalCount) * 100;
        } else {
            $percentage_male = 0;
            $percentage_female  = 0;
        }

        $OmaleMonthlyVisitorCount = DB::table('visitors')
            ->join('time_logs', 'visitors.time_log_id', '=', 'time_logs.id')
            ->join('user_details', 'visitors.user_detail_id', '=', 'user_details.id')
            ->join('residents', 'visitors.resident_id', '=', 'residents.id')
            ->join('units', 'residents.unit_id', '=', 'units.id')
            ->join('blocks', 'units.block_id', '=', 'blocks.id')
            ->join('premises', 'blocks.premise_id', '=', 'premises.id')
            ->join('organizations', 'premises.organization_code', '=', 'organizations.code')
            ->where('user_details.gender', '=', 'Male')
            ->where('organizations.code', $organization_code)
            ->whereMonth('time_logs.entry_time', Carbon::now()->month)
            ->count();
        $OfemaleMonthlyVisitorCount  = DB::table('visitors')
            ->join('time_logs', 'visitors.time_log_id', '=', 'time_logs.id')
            ->join('user_details', 'visitors.user_detail_id', '=', 'user_details.id')
            ->join('residents', 'visitors.resident_id', '=', 'residents.id')
            ->join('units', 'residents.unit_id', '=', 'units.id')
            ->join('blocks', 'units.block_id', '=', 'blocks.id')
            ->join('premises', 'blocks.premise_id', '=', 'premises.id')
            ->join('organizations', 'premises.organization_code', '=', 'organizations.code')
            ->where('user_details.gender', '=', 'Female')
            ->where('organizations.code', $organization_code)
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
            ->join('residents', 'visitors.resident_id', '=', 'residents.id')
            ->join('units', 'residents.unit_id', '=', 'units.id')
            ->join('blocks', 'units.block_id', '=', 'blocks.id')
            ->join('premises', 'blocks.premise_id', '=', 'premises.id')
            ->join('organizations', 'premises.organization_code', '=', 'organizations.code')
            ->where('organizations.code', $organization_code)
            ->whereRaw("time_logs.entry_time >= DATE_SUB(CURRENT_DATE, INTERVAL 6 MONTH)")
            ->groupBy('year', 'month', 'user_details.gender')
            ->get();

        $maleDatabar = [];
        $femaleDatabar = [];

        $monthsbar = [];

        for ($i = 5; $i >= 0; $i--) {
            $month = date('m', strtotime("-$i month")); // get the month number
            $year = date('Y', strtotime("-$i month")); // get the year
            $monthsbar[] = date("M Y", strtotime($year . '-' . $month . '-01')); // format the date as "M Y"
            $maleCount = $BarChart->where('gender', 'male')->where('month', $month)->where('year', $year)->sum('count');
            $femaleCount = $BarChart->where('gender', 'female')->where('month', $month)->where('year', $year)->sum('count');
            $maleDatabar[] = $maleCount;
            $femaleDatabar[] = $femaleCount;
        }

        $labelsbar = collect($monthsbar);

        $Omdata = [
            'labels' => $labelsbar,
            'datasets' => [
                [
                    'label' => 'Male',
                    'backgroundColor' => '#007bff',
                    'data' => $maleDatabar,
                ],
                [
                    'label' => 'Female',
                    'backgroundColor' => '#fd6b37',
                    'data' => $femaleDatabar,
                ]
            ]
        ];
        $monthlyData = DB::table('visitors')
            ->join('residents', 'visitors.resident_id', '=', 'residents.id')
            ->join('units', 'residents.unit_id', '=', 'units.id')
            ->join('blocks', 'units.block_id', '=', 'blocks.id')
            ->join('premises', 'blocks.premise_id', '=', 'premises.id')
            ->join('organizations', 'premises.organization_code', '=', 'organizations.code')
            ->join('user_details', 'visitors.user_detail_id', '=', 'user_details.id')
            ->selectRaw('COUNT(*) as count, FLOOR(DATEDIFF(NOW(), user_details.date_of_birth)/365.25) - 18 as age')
            ->whereRaw('user_details.date_of_birth IS NOT NULL')
            ->whereRaw('user_details.created_at >= DATE_SUB(NOW(), INTERVAL 7 YEAR)')
            ->where('organizations.code', '=', $organization_code)
            ->groupBy('age')
            ->orderBy('age')
            ->get();


        $labels = $monthlyData->pluck('age');
        $data = $monthlyData->pluck('count');

        $OchartData = [
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
        $Ovlabels = TimeLog::whereYear('entry_time', date('Y'))
            ->whereHas('visitor.resident.unit.block.premise.organization', function ($query) use ($organization_code) {
                $query->where('code', $organization_code);
            })
            ->select(DB::raw("MONTH(entry_time) as month_name"))
            ->get();

        $Ovdata = TimeLog::join('visitors', 'visitors.time_log_id', '=', 'time_logs.id')
            ->join('user_details', 'visitors.user_detail_id', '=', 'user_details.id')
            ->join('residents', 'visitors.resident_id', '=', 'residents.id')
            ->join('units', 'residents.unit_id', '=', 'units.id')
            ->join('blocks', 'units.block_id', '=', 'blocks.id')
            ->join('premises', 'blocks.premise_id', '=', 'premises.id')
            ->join('organizations', 'premises.organization_code', '=', 'organizations.code')
            ->where('organizations.code', '=', $organization_code)
            ->whereYear('time_logs.entry_time', date('Y'))
            ->select(DB::raw("COUNT(*) as count"))
            ->get();

        $yearlyMonth = TimeLog::join('visitors', 'visitors.time_log_id', '=', 'time_logs.id')
            ->join('residents', 'residents.id', '=', 'visitors.resident_id')
            ->join('units', 'units.id', '=', 'residents.unit_id')
            ->join('blocks', 'blocks.id', '=', 'units.block_id')
            ->join('premises', 'premises.id', '=', 'blocks.premise_id')
            ->join('organizations', 'organizations.code', '=', 'premises.organization_code')
            ->where('organizations.code', '=', $organization_code)
            ->whereYear('entry_time', Carbon::now()->year)
            ->select(DB::raw('MONTH(entry_time) as month'))
            ->get()
            ->toArray();
        $yearlyCount = TimeLog::join('visitors', 'visitors.time_log_id', '=', 'time_logs.id')
            ->join('residents', 'visitors.resident_id', '=', 'residents.id')
            ->join('units', 'residents.unit_id', '=', 'units.id')
            ->join('blocks', 'units.block_id', '=', 'blocks.id')
            ->join('premises', 'blocks.premise_id', '=', 'premises.id')
            ->join('organizations', 'premises.organization_code', '=', 'organizations.code')
            ->where('organizations.code', $organization_code)
            ->whereYear('entry_time', Carbon::now()->year)
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

        $OyearlyData = json_encode($data);

        $chart = DB::table('visitors')
            ->join('user_details', 'visitors.user_detail_id', '=', 'user_details.id')
            ->join('time_logs', 'visitors.time_log_id', '=', 'time_logs.id')
            ->join('residents', 'visitors.resident_id', '=', 'residents.id')
            ->join('units', 'residents.unit_id', '=', 'units.id')
            ->join('blocks', 'units.block_id', '=', 'blocks.id')
            ->join('premises', 'blocks.premise_id', '=', 'premises.id')
            ->join('organizations', 'premises.organization_code', '=', 'organizations.code')
            ->select(DB::raw('COUNT(*) as total'), DB::raw('FLOOR(DATEDIFF(CURRENT_DATE, user_details.date_of_birth) / 365.25 / 10) * 10 + 18 AS age'))
            ->where('organizations.code', '=', $organization_code)
            ->whereBetween('time_logs.entry_time', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])
            ->groupBy(DB::raw('FLOOR(DATEDIFF(CURRENT_DATE, user_details.date_of_birth) / 365.25 / 10) * 10 + 18'))
            ->orderBy('age')
            ->get()
            ->toArray();

        $Olabelschart = [];
        $Odatachart = [];
        foreach ($chart as $item) {
            $Olabelschart[] = $item->age . ' - ' . ($item->age + 9);
            $Odatachart[] = $item->total;
        }
        $OtotalVisitors = DB::table('visitors')
            ->join('residents', 'visitors.resident_id', '=', 'residents.id')
            ->join('units', 'residents.unit_id', '=', 'units.id')
            ->join('blocks', 'units.block_id', '=', 'blocks.id')
            ->join('premises', 'blocks.premise_id', '=', 'premises.id')
            ->join('organizations', 'premises.organization_code', '=', 'organizations.code')
            ->where('organizations.code', '=', $organization_code)
            ->count();

        $Ounits = Unit::select('units.id', 'units.name', DB::raw('COUNT(*) as visitors_count'))
            ->join('residents', 'residents.unit_id', '=', 'units.id')
            ->join('visitors', 'visitors.resident_id', '=', 'residents.id')
            ->join('time_logs', 'time_logs.id', '=', 'visitors.time_log_id')
            ->join('blocks', 'blocks.id', '=', 'units.block_id')
            ->join('premises', 'premises.id', '=', 'blocks.premise_id')
            ->join('organizations', 'organizations.code', '=', 'premises.organization_code')
            ->where('organizations.code', '=', $organization_code)
            ->whereMonth('time_logs.entry_time', '=', now()->month)
            ->groupBy('units.id', 'units.name')
            ->orderByDesc('visitors_count')
            ->take(5)
            ->get();

        $Opremises = DB::table('premises')
            ->select('premises.name', DB::raw('COUNT(visitors.id) as visitor_count'))
            ->join('blocks', 'premises.id', '=', 'blocks.premise_id')
            ->join('units', 'blocks.id', '=', 'units.block_id')
            ->join('residents', 'units.id', '=', 'residents.unit_id')
            ->join('visitors', 'residents.id', '=', 'visitors.resident_id')
            ->join('time_logs', 'visitors.time_log_id', '=', 'time_logs.id')
            ->where('organization_code', $organization_code)
            ->whereMonth('time_logs.entry_time', Carbon::now()->month)
            ->groupBy('premises.name')
            ->orderByDesc('visitor_count')
            ->limit(5)
            ->get();

        $visitorsData = DB::table('visitors')
            ->join('residents', 'residents.id', '=', 'visitors.resident_id')
            ->join('units', 'units.id', '=', 'residents.unit_id')
            ->join('blocks', 'blocks.id', '=', 'units.block_id')
            ->join('premises', 'premises.id', '=', 'blocks.premise_id')
            ->join('organizations', 'organizations.code', '=', 'premises.organization_code')
            ->select(DB::raw('DATE(visitors.created_at) as date'), DB::raw('COUNT(*) as count'))
            ->whereRaw('YEAR(visitors.created_at) = YEAR(CURRENT_DATE)')
            ->where('organizations.code', '=', $organization_code)
            ->groupBy('date')
            ->orderBy('date')
            ->get();
        $dates = $visitorsData->pluck('date')->toArray();
        $OvisitorCounts = $visitorsData->pluck('count')->toArray();

        $OchartDataL = [
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
                    'data' => $OvisitorCounts,
                ]
            ]
        ];

        return view(
            'dashboard',
            [
                'OtotalVisitorsToday' => $OtodayVisit,
                'OyesterdayVisitor' => $OyesterdayVisits,
                'OtotalThisWeek' => $OtotalWeekVisit,
                'OtotalLastWeekVisit' => $OtotalLastWeekVisit,
                'OtotalVehicleWeek' => $OtotalVehicleVisit,
                'OtotalLastVehicleVisit' => $OtotalLastVehicleVisit,
                'OtotalMaleLastWeek' => $OtotalMaleLastWeek,
                'OtotalFemaleLastWeek' => $OtotalFemaleLastWeek,
                'OBarChart' => json_encode($Omdata),
                'OfemaleCount' => $OfemaleCount,
                'OmaleCount' => $OmaleCount,
                'OtotalVisitors' => $OtotalVisitors,
                'OchartData' => $OchartData,
                'Ovlabels' => $Ovlabels,
                'Ovdata' => $Ovdata,
                'OwalkinThisWeek' => $OwalkinThisWeek,
                'OwalkinLastWeek' => $OwalkinLastWeek,
                'OdriveinLastWeek' => $OdriveinLastWeek,
                'OdriveinThisWeek' => $OdriveinThisWeek,
                'OipassLastWeek' => $OipassLastWeek,
                'OipassThisWeek' => $OipassThisWeek,
                'OidThisWeek' => $OidThisWeek,
                'OidLastWeek' => $OidLastWeek,
                'OsmsThisWeek' => $OsmsThisWeek,
                'OsmsLastWeek' => $OsmsLastWeek,
                'OyearlyData' => $OyearlyData,
                'OmaleMonthlyVisitorCount' => $OmaleMonthlyVisitorCount,
                'OfemaleMonthlyVisitorCount' => $OfemaleMonthlyVisitorCount,
                'Olabelschart' => $Olabelschart,
                'Odatachart' => $Odatachart,
                'Ounits' => $Ounits,
                'Opremises' => $Opremises,
                'OchartDataL' => $OchartDataL,
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
