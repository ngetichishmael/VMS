<?php

namespace App\Http\Controllers;

use App\Models\IdentificationType;
use App\Http\Requests\StoreIdentificationTypeRequest;
use App\Http\Requests\UpdateIdentificationTypeRequest;

class IdentificationTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('livewire.identification-type.layout');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreIdentificationTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreIdentificationTypeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\IdentificationType  $identificationType
     * @return \Illuminate\Http\Response
     */
    public function show(IdentificationType $identificationType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\IdentificationType  $identificationType
     * @return \Illuminate\Http\Response
     */
    public function edit(IdentificationType $identificationType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateIdentificationTypeRequest  $request
     * @param  \App\Models\IdentificationType  $identificationType
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateIdentificationTypeRequest $request, IdentificationType $identificationType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\IdentificationType  $identificationType
     * @return \Illuminate\Http\Response
     */
    public function destroy(IdentificationType $identificationType)
    {
        //
    }
}
