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
        return response()->json(Visitor::with(['resident2', 'sentry', 'purpose', 'visitorType', 'timeLogs'])->where('sentry_id', $request->user()->id)
            ->where('type', 'sms')
            ->get());
    }
    public function smsUncheckout(Request $request)
    {
        return response()->json(
            Visitor::with(['resident2', 'sentry', 'purpose', 'visitorType'])
                ->where('sentry_id', $request->user()->id)
                ->where('type', 'sms')
                ->whereIn('time_log_id', function ($query) {
                    $query->selectRaw('MAX(time_log_id)')
                        ->from('visitors')
                        ->groupBy('user_detail_id');
                })
                ->whereHas('timeLogs', function ($query) {
                    $query->whereNull('exit_time');
                })
                ->orderBy('time_log_id', 'desc')
                ->get()
                ->unique('user_detail_id')
        );
    }
    public function smsCheckout(Request $request)
    {
        $timeLogId = $request->input('timeLogId');
        $timeLog = TimeLog::find($timeLogId);
        if (!$timeLog) {
            return response()->json(['message' => 'Time log not found'], 404);
        }

        if ($timeLog->exit_time) {
            return response()->json(['message' => 'Time log already checked out'], 400);
        }

        $timeLog->exit_time = now();
        $timeLog->save();

        return response()->json(['message' => 'Time log checked out successfully']);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone1' => 'required',

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
        $visitor->name = $request->input('phone1');
        $visitor->type = $request->input('type');
        $visitor->identification_type_id = $request->input('identification_type_id');
        $visitor->visitor_type_id = $request->input('visitor_type_id');
        $visitor->purpose_id = $request->input('purpose_id');
        $visitor->sentry_id = $request->user()->id;
        $visitor->nationality_id = $nationality->id ?? "101";
        $visitor->resident_id = $request->input('resident_id');
         $visitor->attachment1=$request->input('attachment1');
         $visitor->attachment2=$request->input('attachment2');
         $visitor->attachment3=$request->input('attachment3');
         $visitor->attachment4=$request->input('attachment4');
        $visitor->tag = $request->input('tag');


        $timeLog->save();

        $visitor->time_log_id = $timeLog->id;

        $user_details = UserDetail::find($request->IDNO);
        if (!$user_details) {
            $user_details = new UserDetail();
            $user_details->phone_number = $request->input('phone1');
            $user_details->secondary_phone_number = $request->input('phone2') ?? "NULL";
            $user_details->date_of_birth = $request->input('DOB') ?? "NULL";
            $user_details->ID_number = $request->input('IDNO') ?? "NULL";
            $user_details->gender = $request->input('gender');
            $user_details->image = $request->input('image');
            $user_details->company = $request->input('company');
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
