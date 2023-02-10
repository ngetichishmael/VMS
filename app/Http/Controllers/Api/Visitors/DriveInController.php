<?php

namespace App\Http\Controllers\Api\Visitors;

use App\Http\Controllers\Controller;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DriveInController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json(Visitor::with(['organization', 'premises', 'vehicle', 'nationality', 'tag', 'visitorType'])->where('type','drivein')->get());
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'phoneNumber' => 'required|string',
            'gender' => 'required|string',
            'type' => 'required|string',
            'purpose' => 'required|string',
            'organizationId' => 'required|exists:organizations,id',
            'premisesId' => 'required|exists:premises,id',
            'nationalityId' => 'required|exists:nationality,id',
            'vehicleId' => 'required|exists:vehicle_information,id',
            'tagId' => 'required|exists:tags,id',
            'visitorTypeId' => 'required|exists:visitortype,id',
            'hostName' => 'required|string',
            'site' => 'required|string',
            'section' => 'required|string',
            'timeIn' => 'required|date_format:Y-m-d H:i:s',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $visitor = Visitor::create($request->all());

        return response()->json($visitor, 201);
    }

    public function show(Visitor $visitor): Visitor
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
