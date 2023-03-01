<?php

namespace App\Http\Controllers;

use App\Models\TimeLog;
use App\Http\Requests\StoreTimeLogRequest;
use App\Http\Requests\UpdateTimeLogRequest;

class TimeLogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreTimeLogRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTimeLogRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TimeLog  $timeLog
     * @return \Illuminate\Http\Response
     */
    public function show(TimeLog $timeLog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TimeLog  $timeLog
     * @return \Illuminate\Http\Response
     */
    public function edit(TimeLog $timeLog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTimeLogRequest  $request
     * @param  \App\Models\TimeLog  $timeLog
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTimeLogRequest $request, TimeLog $timeLog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TimeLog  $timeLog
     * @return \Illuminate\Http\Response
     */
    public function destroy(TimeLog $timeLog)
    {
        //
    }
}
