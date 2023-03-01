<?php

namespace App\Http\Controllers;

use App\Models\VisitorType;
use App\Http\Requests\StoreVisitorTypeRequest;
use App\Http\Requests\UpdateVisitorTypeRequest;

class VisitorTypeController extends Controller
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
     * @param  \App\Http\Requests\StoreVisitorTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVisitorTypeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VisitorType  $visitorType
     * @return \Illuminate\Http\Response
     */
    public function show(VisitorType $visitorType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VisitorType  $visitorType
     * @return \Illuminate\Http\Response
     */
    public function edit(VisitorType $visitorType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateVisitorTypeRequest  $request
     * @param  \App\Models\VisitorType  $visitorType
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVisitorTypeRequest $request, VisitorType $visitorType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VisitorType  $visitorType
     * @return \Illuminate\Http\Response
     */
    public function destroy(VisitorType $visitorType)
    {
        //
    }
}
