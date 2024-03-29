<?php

namespace App\Http\Controllers\Visit;

use App\Http\Controllers\Controller;
use App\Models\TimeLog;
use App\Models\Visitor;
use App\Models\WalkIn;
use Illuminate\Http\Request;

class iPassCheckinsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        return view('app.visitor.ipasscheckins.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $visitor = WalkIn::with('purpose1', 'sentry', 'timeLogs')->whereId($id)->firstOrFail();
        $userDetailId = $visitor->user_details->id;
        $visitorCount = Visitor::where('user_detail_id', $userDetailId)->count();
        $visitorTimeLogs = TimeLog::join('visitors', 'time_logs.id', '=', 'visitors.time_log_id')
            ->where('visitors.user_detail_id', $userDetailId)
            ->orderBy('entry_time', 'desc')
            ->get();
        $lastTimeLog = $visitorTimeLogs->last();

        return view('app.visitor.ipasscheckins.visitorDetails', compact('visitor', 'visitorTimeLogs', 'visitorCount', 'lastTimeLog'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
