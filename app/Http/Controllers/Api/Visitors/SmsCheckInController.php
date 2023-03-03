<?php

namespace App\Http\Controllers\Api\Visitors;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Nationality;
use App\Models\Sentry;
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
        $vehicle = null;
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }
        $user_details = UserDetail::where('ID_number', $request->input('IDNO'))
            ->orWhere('phone_number', $request->input('phone1'))
            ->first();
        if ($user_details) {
            $visitor = Visitor::where('user_detail_id', $user_details->id)->latest('id')->first();

            if ($visitor && $visitor->time_log_id) {
                $timeLog = TimeLog::find($visitor->time_log_id);

                if ($timeLog && $timeLog->exit_time === null) {
                    return response()->json(['error' => 'User already signed in, If its by mistake, Sign the user out first to sign back in'],409);
                }
            }
        }
        $nationality = Nationality::find($request->nationality);

        if (!$nationality) {
            $nationality = new Nationality();
            $nationality->name = $request->input('nationality') ?? '101';
            $nationality->save();
        }

        $detail=Sentry::where('phone_number', $request->user()->phone_number ?? '')->first();

        $visitor = new Visitor();
        $visitor->type = $request->input('type');
        $visitor->identification_type_id = $request->input('identification_type_id');
        $visitor->visitor_type_id = $request->input('visitor_type_id');
        $visitor->purpose_id = $request->input('purpose_id');
        $visitor->sentry_id = $detail->id;
        $visitor->nationality_id = $nationality->id ?? "101";
        $visitor->resident_id = $request->input('resident_id');
        if ($request->hasFile('attachment1')) {
            $path = $request->file('attachment1')->store('public/attachments');
            $visitor->attachment1 = basename($path);
        }

        if ($request->hasFile('attachment2')) {
            $path = $request->file('attachment2')->store('public/attachments');
            $visitor->attachment2 = basename($path);
        }

        if ($request->hasFile('attachment3')) {
            $path = $request->file('attachment3')->store('public/attachments');
            $visitor->attachment3 = basename($path);
        }

        if ($request->hasFile('attachment4')) {
            $path = $request->file('attachment4')->store('public/attachments');
            $visitor->attachment4 = basename($path);
        }
        $visitor->tag = $request->input('tag');


         $timeLog = new TimeLog;
        $timeLog->entry_time = now();
        $timeLog->save();
        $visitor->time_log_id = $timeLog->id;

        $user_details = UserDetail::where('ID_number', $request->input('IDNO'))
            ->orWhere('phone_number', $request->input('phone1'))
            ->first();
        if (!$user_details) {
            $user_details = new UserDetail();
            $user_details->phone_number = $request->input('phone1');
            $user_details->secondary_phone_number = $request->input('phone2') ?? "NULL";
            $user_details->date_of_birth = $request->input('DOB') ?? "NULL";
            $user_details->ID_number = $request->input('IDNO') ?? "NULL";
            $user_details->gender = $request->input('gender');
            if ($request->hasFile('image')) {
                $path = $request->file('image')->store('public/attachments');
                $user_details->image= basename($path);
            }
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

        Activity::create([
            'name' => $request->user()->name,
            'target' => "new sms checking created by " . $request->user()->name,
            'organization' => 'Visitor by name' . $visitor->name,
            'activity' => "Created a new visitor with " . $visitor .
                'with details: ' . $user_details  . ' and vehicle ' . $vehicle

        ]);
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
