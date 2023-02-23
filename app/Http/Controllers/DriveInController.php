<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDriveInRequest;
use App\Http\Requests\UpdateDriveInRequest;
use App\Models\DriveIn;
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
    public function show( $driveIn)
    {

         $visitor = DriveIn::with('nationality','user_details','purpose1','sentry')->find($driveIn);
            $entryTime = Carbon::parse($visitor->timeLogs->entry_time);
            $exitTime = Carbon::parse($visitor->timeLogs->exit_time);
            $duration = $entryTime->diff($exitTime);
            $visitor->duration = $duration->format('%H Hours %I Minutes %S Seconds');
        $visitorCount = DriveIn::where('user_detail_id', $visitor->user_details->id)->count();

        return view('app.visitor.drivers.visitorDetails',compact('visitor', 'visitorCount'));
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
