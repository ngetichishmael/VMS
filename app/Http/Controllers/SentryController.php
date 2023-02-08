<?php

namespace App\Http\Controllers;

use App\Models\Sentry;
use App\Http\Requests\StoreSentryRequest;
use App\Http\Requests\UpdateSentryRequest;

class SentryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $sentries = DB::table('sentries')
        ->join('organizations', 'users.org', '=', 'organizations.id')
      
        ->select('users.*', 'organizations.org_name')
        ->get();
      

        return view('livewire.sentry.dashboard',compact('sentries'));

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
     * @param  \App\Http\Requests\StoreSentryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSentryRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sentry  $sentry
     * @return \Illuminate\Http\Response
     */
    public function show(Sentry $sentry)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sentry  $sentry
     * @return \Illuminate\Http\Response
     */
    public function edit(Sentry $sentry)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSentryRequest  $request
     * @param  \App\Models\Sentry  $sentry
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSentryRequest $request, Sentry $sentry)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sentry  $sentry
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sentry $sentry)
    {
        //
    }
}