<?php

namespace App\Http\Controllers;

use App\Models\VehicleInformation;
use App\Http\Requests\StoreVehicleInformationRequest;
use App\Http\Requests\UpdateVehicleInformationRequest;

class VehicleInformationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('livewire.vehicle.dashboard');
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
     * @param  \App\Http\Requests\StoreVehicleInformationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVehicleInformationRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VehicleInformation  $vehicleInformation
     * @return \Illuminate\Http\Response
     */
    public function show(VehicleInformation $vehicleInformation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VehicleInformation  $vehicleInformation
     * @return \Illuminate\Http\Response
     */
    public function edit(VehicleInformation $vehicleInformation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateVehicleInformationRequest  $request
     * @param  \App\Models\VehicleInformation  $vehicleInformation
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVehicleInformationRequest $request, VehicleInformation $vehicleInformation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VehicleInformation  $vehicleInformation
     * @return \Illuminate\Http\Response
     */
    public function destroy(VehicleInformation $vehicleInformation)
    {
        //
    }
}
