<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use App\Http\Requests\StoreVisitorRequest;
use App\Http\Requests\UpdateVisitorRequest;
use Database\Seeders\VisitorSeeder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VisitorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Visitor[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Http\Response
     */
    public function index()
    {
        return Visitor::all();
    }

    public function store(Request $request)
    {

        $visitor = Visitor::create($request->all());
        return response()->json($visitor, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Visitor $visitor)
    {
        return Visitor::with(['organization', 'premise', 'vehicle', 'nationality', 'tag'])->find($visitor->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Visitor  $visitor
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Visitor  $visitor
     * @return \Illuminate\Http\Response
     */
    public function edit(Visitor $visitor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateVisitorRequest  $request
     * @param  \App\Models\Visitor  $visitor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        info(request());
        $visitor = Visitor::find($request->query('visitor'));
        info("visitor is ".$visitor);

        if($visitor->status==1){
            $whitelisted_by=request()->user()->user_code;
            $visitor->whitelisted_by=$whitelisted_by;
        }
        else{
            $blacklisted_by =request()->user()->user_code;
            $visitor->blacklisted_by=$blacklisted_by;
        }
        $visitor->status = request()->query('status') == 1 ? 1 : 0;
        $visitor->save();
        return back()->with('success', 'Status Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Visitor  $visitor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Visitor $visitor)
    {
        //
    }
}
