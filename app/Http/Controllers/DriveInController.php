<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDriveInRequest;
use App\Http\Requests\UpdateDriveInRequest;
use App\Models\DriveIn;
use App\Models\TimeLog;
use App\Models\Visitor;
use App\Models\VisitorType;
use Carbon\Carbon;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\DB;

class DriveInController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('app.visitor.drivers.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDriveInRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDriveInRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DriveIn  $driveIn
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show($driveIn)
    {

//        $visitor = DriveIn::with('purpose1', 'sentry', 'timeLogs')->whereId($driveIn)->first();
//        $visitorCount = Visitor::where('user_detail_id', $visitor->user_details->id)->count();
//        $lastTimeLog = TimeLog::where('id', $visitor->time_log_id)->orderBy('id', 'desc')->first();
//        $historyTimeLogs = TimeLog::where('visitor_id', $visitor->id)->orderBy('entry_time', 'desc')->get();
        $visitor = DriveIn::with('purpose1', 'sentry', 'timeLogs')->whereId($driveIn)->first();
        $visitorCount = Visitor::where('user_detail_id', $visitor->user_details->id)->count();
        $visitorTimeLogs = TimeLog::join('visitors', 'time_logs.id', '=', 'visitors.time_log_id')
            ->where('time_logs.id', $visitor->time_log_id)
            ->where('visitors.user_detail_id', $visitor->user_details->id)
            ->get();

        $lastTimeLog = $visitorTimeLogs->last();
        return view('app.visitor.drivers.visitorDetails', compact('visitor', 'visitorTimeLogs', 'visitorCount', 'lastTimeLog'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DriveIn  $driveIn
     * @return \Illuminate\Http\Response
     */
    public function edit(DriveIn $driveIn)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDriveInRequest  $request
     * @param  \App\Models\DriveIn  $driveIn
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDriveInRequest $request, DriveIn $driveIn)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DriveIn  $driveIn
     * @return \Illuminate\Http\Response
     */
    public function destroy(DriveIn $driveIn)
    {
        //
    }
}
