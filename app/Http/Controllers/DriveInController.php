<?php

namespace App\Http\Controllers;

use App\Models\DriveIn;
use App\Http\Requests\StoreDriveInRequest;
use App\Http\Requests\UpdateDriveInRequest;

class DriveInController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('livewire.visit.drivers.dashboard');
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
     * @return \Illuminate\Http\Response
     */
    public function show(DriveIn $driveIn)
    {
        //
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
