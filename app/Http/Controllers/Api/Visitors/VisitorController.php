<?php

namespace App\Http\Controllers\Api\Visitors;

use App\Http\Controllers\Controller;
use App\Models\Visitor;
use Illuminate\Http\Request;
use App\Models\Organization;
use App\Models\Premise;
use App\Models\VehicleInformation;
use App\Models\Nationality;
use App\Models\Tag;

class VisitorController extends Controller
{
    public function organizationOptions()
    {
        return Organization::all();
    }

    public function premisesOptions()
    {
        return Premise::all();
    }

    public function vehicleOptions()
    {
        return VehicleInformation::all();
    }

    public function nationalityOptions()
    {
        return Nationality::all();
    }

    public function tagOptions()
    {
        return Tag::all();
    }

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
        $validatedData = $request->validate([
            'name' => 'required',
            'phoneNumber' => 'required',
            'gender' => 'required',
            'type' => 'required',
            'organizationId' => 'required',
            'premisesId' => 'required',
            'vehicleId' => 'required',
            'nationalityId' => 'required',
            'tagId' => 'required',
            'hostName' => 'required',
            'site' => 'required',
            'section' => 'required'
        ]);

        $visitor = Visitor::create($validatedData);

        return response()->json($visitor, 201);
    }

    public function show($id)
    {
        $visitor = Visitor::findOrFail($id);

        return response()->json($visitor);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
//    public function show(Visitor $visitor)
//    {
//        return Visitor::with(['organization', 'premise', 'vehicle', 'nationality', 'tag'])->find($visitor->id);
//    }
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
