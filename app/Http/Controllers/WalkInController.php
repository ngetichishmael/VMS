<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWalkInRequest;
use App\Http\Requests\UpdateWalkInRequest;
use App\Models\DriveIn;
use App\Models\TimeLog;
use App\Models\Visitor;
use App\Models\WalkIn;
use Carbon\Carbon;

class WalkInController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('app.visitor.walks.index');
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
     * @param  \App\Http\Requests\StoreWalkInRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreWalkInRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WalkIn  $walkIn
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */

    public function show($walkIn)
    {
        $visitor = WalkIn::with('purpose1', 'sentry', 'timeLogs')->whereId($walkIn)->firstOrFail();
        $userDetailId = $visitor->user_details->id;
        $visitorCount = Visitor::where('user_detail_id', $userDetailId)->count();
        $visitorTimeLogs = TimeLog::join('visitors', 'time_logs.id', '=', 'visitors.time_log_id')
            ->where('visitors.user_detail_id', $userDetailId)
            ->orderBy('entry_time', 'desc')
            ->get();
        $lastTimeLog = $visitorTimeLogs->last();

        return view('app.visitor.walks.visitorDetails', compact('visitor', 'visitorTimeLogs', 'visitorCount', 'lastTimeLog'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WalkIn  $walkIn
     * @return \Illuminate\Http\Response
     */
    public function edit(WalkIn $walkIn)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateWalkInRequest  $request
     * @param  \App\Models\WalkIn  $walkIn
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateWalkInRequest $request, WalkIn $walkIn)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WalkIn  $walkIn
     * @return \Illuminate\Http\Response
     */
    public function destroy(WalkIn $walkIn)
    {
        //
    }
}
