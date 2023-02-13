<?php

namespace App\Http\Controllers\Api\Visitors;

use App\Http\Controllers\Controller;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        return response()->json(Visitor::with(['resident2','createdBy', 'purpose', 'vehicle', 'visitorType', 'timeLogs'])->where('type','drivein')->get());
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'type' => 'required|string',
            'identification_type_id' => 'required|integer',
            'visitor_type_id' => 'required|integer',
            'purpose_id' => 'required|integer',
            'nationality_id' => 'required|integer',
            'resident_id' => 'required|integer',
            'time_log_id' => 'required|integer',
            'registration' => 'required|string',
            'vehicle_type' => 'required|string',
//            'color' => 'required|string',
//            'model' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        // Create a new visitor record
        $visitor = new Visitor();
        $visitor->name = $request->input('name');
        $visitor->type = $request->input('type');
        $visitor->identification_type_id = $request->input('identification_type_id');
        $visitor->visitor_type_id = $request->input('visitor_type_id');
        $visitor->purpose_id = $request->input('purpose_id');
        dd($visitor->sentry_id = Auth::id());
        $visitor->nationality_id = $request->input('nationality_id');
        $visitor->resident_id = $request->input('resident_id');
        $visitor->time_log_id = $request->input('time_log_id');
        $visitor->save();

        // Create a new vehicle_information record
        $vehicle = new VehicleInformation();
        $vehicle->registration = $request->input('registration');
        $vehicle->type = $request->input('vehicle_type');
        $vehicle->color = $request->input('color');
        $vehicle->model = $request->input('model');
        $vehicle->visitor_id = $visitor->id;
        $vehicle->save();

        return response()->json(['success' => 'Visitor and vehicle information added successfully.'], 201);
    }



//    public function store(Request $request)
//    {
//        $validatedData = $request->validate([
//            'name' => 'required|string',
//            'phoneNumber' => 'required|string',
//            'gender' => 'required|string',
//            'type' => 'required|string',
//            'purpose_id' => 'required|exists:purposes,id',
////            'organizationId' => 'required|exists:organizations,id',
////            'premisesId' => 'required|exists:premises,id',
//            'nationality_id' => 'required',
////            'tag_id' => 'required|exists:tags,id',
//            'visitor_type_id' => 'required|exists:visitor_types,id',
////            'sentry_id' => 'required|exists:sentry, id',
//
////            'timeIn' => 'required|date_format:Y-m-d H:i:s',
//        ]);
//        /** @var TYPE_NAME $validatedData */
//        if ($validatedData->fails()) {
//            return response()->json($validatedData->errors(), 400);
//        }
//
//        $visitor = Visitor::create([
//            'name' => $validatedData['name'],
//            'type' => $validatedData['type'],
//            'identification_type_id' => $validatedData['identification_type_id'],
//            'visitor_type_id' => $validatedData['visitor_type_id'],
//            'purpose_id' => $validatedData['purpose_id'],
//            'sentry_id' => auth()->user()->id,
//            'nationality_id' => $validatedData['nationality_id'],
//            'resident_id' => $validatedData['resident_id'],
//            'time_log_id' => $validatedData['time_log_id'],
//        ]);
//
//        return response()->json($visitor, 201);
//    }

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
