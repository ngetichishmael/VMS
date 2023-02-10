<?php

namespace App\Http\Controllers\Api\Visitors;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DriveInController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
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

    public function show(Visitor $visitor)
    {
        return $visitor;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
