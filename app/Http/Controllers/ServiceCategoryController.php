<?php

namespace App\Http\Controllers;

use App\Models\ServiceCategory;
use App\Http\Requests\StoreServiceCategoryRequest;
use App\Http\Requests\UpdateServiceCategoryRequest;

class ServiceCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('livewire.service.catergory.dashboard');
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
     * @param  \App\Http\Requests\StoreServiceCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreServiceCategoryRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ServiceCategory  $serviceCategory
     * @return \Illuminate\Http\Response
     */
    public function show(ServiceCategory $serviceCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ServiceCategory  $serviceCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(ServiceCategory $serviceCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateServiceCategoryRequest  $request
     * @param  \App\Models\ServiceCategory  $serviceCategory
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateServiceCategoryRequest $request, ServiceCategory $serviceCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ServiceCategory  $serviceCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(ServiceCategory $serviceCategory)
    {
        //
    }
}