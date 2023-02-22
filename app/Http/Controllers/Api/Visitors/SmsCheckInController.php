<?php

namespace App\Http\Controllers\Api\Visitors;

use App\Http\Controllers\Controller;
use App\Models\Nationality;
use App\Models\TimeLog;
use App\Models\UserDetail;
use App\Models\VehicleInformation;
use App\Models\Visitor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SmsCheckInController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        return response()->json(Visitor::with(['resident2', 'createdBy', 'purpose', 'visitorType', 'timeLogs'])->where('sentry_id', $request->user()->id)
            ->where('type', 'sms')
            ->get());
    }
    public function smsUncheckout(Request $request)
    {
        return response()->json(Visitor::with(['resident2', 'sentry', 'purpose', 'visitorType'])
        ->where('sentry_id', $request->user()->id)
        ->where('type', 'sms')
        ->whereHas('timeLogs', function ($query) {
            $query->whereNull('exit_time');
        })
        ->latest()
        ->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $userTimezone = $request->header('X-Timezone');
        // Validate the request data

        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'type' => 'required|string',
            'identification_type_id' => 'required|integer',
            'visitor_type_id' => 'required|integer',
            'purpose_id' => 'required|integer',
            'nationality' => 'required|string',
            'resident_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }
        $nationality = Nationality::find($request->nationality);
        $timeLog = new TimeLog;
        $now = Carbon::now();
        $nairobiNow = $now->setTimezone('Africa/Nairobi');
        $timeLog->entry_time = $nairobiNow->format('Y-m-d H:i:s');

        $visitor = new Visitor();
        $visitor->name = $request->input('name');
        $visitor->type = $request->input('type');
        $visitor->identification_type_id = $request->input('identification_type_id');
        $visitor->visitor_type_id = $request->input('visitor_type_id');
        $visitor->purpose_id = $request->input('purpose_id');
        $visitor->sentry_id = $request->user()->id;
        $visitor->nationality_id = $nationality->id ?? "101";
        $visitor->resident_id = $request->input('resident_id');
        $visitor->tag = $request->input('tag');


        $timeLog->save();

        $visitor->time_log_id = $timeLog->id;

        $user_details = UserDetail::where('ID_number', $request['IDNO'])->first();
        if (!$user_details) {
            $user_details = new UserDetail();
            $user_details->phone_number = $request->input('phone1');
            $user_details->secondary_phone_number = $request->input('phone2') ?? "NULL";
            $user_details->date_of_birth = $request->input('DOB') ?? "NULL";
            $user_details->ID_number = $request->input('IDNO') ?? "NULL";
            $user_details->gender = $request->input('gender');
            $user_details->save();
        }
        $visitor->user_detail_id = $user_details->id;
        $visitor->save();
        if ($request->registration !== null) {
            $vehicle = new VehicleInformation();
            $vehicle->registration = $request->registration;
            $vehicle->visitor_id = $visitor->id;
            $vehicle->save();
        }

        return response()->json(['success' => 'Visitor verified by sms information added successfully.'], 201);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
