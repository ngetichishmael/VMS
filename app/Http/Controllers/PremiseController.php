<?php

namespace App\Http\Controllers;

use App\Models\Premise;
use App\Http\Requests\StorePremiseRequest;
use App\Http\Requests\UpdatePremiseRequest;

class PremiseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('livewire.premises.premise.dashboard');
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
     * @param  \App\Http\Requests\StorePremiseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePremiseRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Premise  $premise
     * @return \Illuminate\Http\Response
     */
    public function show(Premise $premise)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Premise  $premise
     * @return \Illuminate\Http\Response
     */
    public function edit(Premise $premise)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePremiseRequest  $request
     * @param  \App\Models\Premise  $premise
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePremiseRequest $request, Premise $premise)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Premise  $premise
     * @return \Illuminate\Http\Response
     */
    public function destroy(Premise $premise)
    {
        //
    }
}