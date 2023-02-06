<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWalkInRequest;
use App\Http\Requests\UpdateWalkInRequest;
use App\Models\WalkIn;

class WalkInController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('livewire.visit.walks.dashboard');
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
     * @return \Illuminate\Http\Response
     */
    public function show(WalkIn $walkIn)
    {
        //
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
