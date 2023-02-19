<?php

namespace App\Http\Controllers\Api\Visitors;

use App\Http\Controllers\Controller;
use App\Models\IdentificationType;
use App\Models\Purpose;
use App\Models\Resident;
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
    public function identificationOptions()
    {
        return IdentificationType::all();
    }

    public function premisesOptions()
    {
        return Premise::all();
    }

    public function tagOptions()
    {
        return Tag::all();
    }
    public function purposeOptions()
    {
        return Purpose::all();
    }
    public function hostOptions()
    {
        return Resident::all();
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {

        return response()->json(Visitor::with(['resident2','createdBy', 'purpose', 'vehicle', 'visitorType', 'timeLogs'])->where('sentry_id', $request->user()->id)->get());
    }
    public function checkout(Request $request, Visitor $visitor)
    {

        $timeLog = $visitor->timeLogs;
        if (!$timeLog) {
            return response()->json(['error' => 'Visitor not found'], 404);
        }
        if ($timeLog->exit_time) {
            return response()->json(['error' => 'Visitor has already checked out'], 400);
        }

        $timeLog->update([
            'exit_time' => now(),
        ]);

        return response()->json(['message' => 'Visitor checked out successfully', 200]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {

        $visitor = Visitor::with(['organization', 'vehicle', 'purpose', 'visitorType'])->get()->where('id', $id)->first();
        if (!$visitor) {
            return response()->json(['message' => 'Visitor not found'], 404);
        }

        return response()->json($visitor);

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
