<?php

namespace App\Http\Controllers\Api\Visitors;

use App\Http\Controllers\Controller;
use App\Models\IdentificationType;
use App\Models\Nationality;
use App\Models\Purpose;
use App\Models\Resident;
use App\Models\Sentry;
use App\Models\TimeLog;
use App\Models\UserDetail;
use App\Models\VehicleInformation;
use App\Models\Visitor;
use App\Models\VisitorType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Organization;
use App\Models\Premise;
use Illuminate\Support\Facades\Validator;

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

    public function visitorTypeOptions()
    {
        return VisitorType::all();
    }
    public function purposeOptions()
    {
        return Purpose::all();
    }
    public function hostOptions()
    {
        return Resident::all();
    }
    public function unitOptions(Request $request)
    {

        $sentry = Sentry::where('user_detail_id', $request->user()->id)->get();
        return response()->json($sentry);
        if (!$sentry){
            return response()->json(['Error' => 'Sentry details not found'], 404);
        }
        $units = Premise::with('blocks.units')->where('id', $sentry->premise_id)->get();
        return response()->json($units);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        return response()->json(Visitor::with(['resident2', 'sentry', 'purpose', 'vehicle', 'visitorType', 'timeLogs'])->where('sentry_id', $request->user()->id)->get());
    }
    public function verifyUser(Request $request)
    {
        $id_number = $request->input('id_number');
        $user = UserDetail::where('ID_number', $id_number)->first();

        if (!$user) {
            return response()->json(['message' => 'Visitor not found'], 404);
        }
        $visitor = Visitor::where('user_detail_id',  $user->id)->orderBy('id', 'desc')->first();
        $time_log = TimeLog::where('id', $visitor->time_log_id)
            ->whereNull('exit_time')
            ->first();
        if (!$time_log) {
            return response()->json(['message' => 'User has already exited'], 400);
        }

        return response()->json(['Message' => 'Visitor exists', 'visitor' => $visitor], 200);
    }
    public function checkout(Request $request)
    {
        $user_details = TimeLog::whereId($request->time_log_id)->first();
        if ($user_details) {
            $result = TimeLog::whereId($request->time_log_id)->update([
                'exit_time' => now(),
            ]);
            if ($result === 0) {
                return response()->json(
                    ['message' => 'Visitor time log does not exist or has already checked out!'],
                    406
                );
            }
            return response()->json(['message' => 'Visitor checked out successfully', 'result' => $result], 200);
        }

        return response()->json(
            [
                'status' => 406,
                'message' => 'An error occurred while checking out the customer',
            ],
            406
        );
    }
    public function returningVisitorVerify(Request $request)
    {
        $number = $request->input('number');
        $stripped_number = preg_replace('/[^0-9]/', '', $number);
        $user = UserDetail::whereRaw("REPLACE(phone_number, '-', '') LIKE '%$stripped_number'")
            ->orwhere('ID_number', $number)->orwhere('phone_number', $number)->first();
        //$user = UserDetail::where('ID_number', $number)->orWhere('phone_number', $number)->first();

        if (!$user) {
            return response()->json(['message' => 'Visitor not found'], 404);
        }

        $visitor = Visitor::where('user_detail_id',  $user->id)->orderBy('id', 'desc')->first();
        $time_log = TimeLog::where('id', $visitor->time_log_id)
            ->whereNull('exit_time')
            ->first();
        if ($time_log) {
            return response()->json(['message' => 'User has already checked in'], 400);
        }
        if ($visitor->type === 'DriveIn') {
            $visitor->vehicle = VehicleInformation::where('visitor_id', $visitor->id)->first();
            return response()->json(['Message' => 'Visitor exists and has a Vehicle details', 'visitor' => $visitor], 200);
        }

        return response()->json(['Message' => 'Visitor exists', 'visitor' => $visitor], 200);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $timeLog = new TimeLog;
        $now = Carbon::now();
        $nairobiNow = $now->setTimezone('Africa/Nairobi');
        $timeLog->entry_time = $nairobiNow->format('Y-m-d H:i:s');

        $nationality = Nationality::find($request->nationality);
        $visitor = new Visitor();
        $visitor->name = $request->input('name');
        $visitor->type = $request->input('type');
//        $visitor->identification_type_id = $request->input('identification_type_id');
        $visitor->visitor_type_id = $request->input('visitor_type_id');
        $visitor->purpose_id = $request->input('purpose_id');
        $visitor->sentry_id = $request->user()->id;
        $visitor->nationality_id = $nationality->id ?? "101";
        $visitor->resident_id = $request->input('resident_id');
        $visitor->attachment1 = $request->input('attachment1');
        $visitor->attachment2 = $request->input('attachment2');
        $visitor->attachment3 = $request->input('attachment3');
        $visitor->attachment4 = $request->input('attachment4');
        $visitor->tag = $request->input('tag');
        $timeLog->save();

        $visitor->time_log_id = $timeLog->id;
        $visitor->user_detail_id = $request->input('user_detail_id');
        $visitor->save();
        if ($request->registration !== null) {
            $vehicle = new VehicleInformation();
            $vehicle->registration = $request->registration;
            $vehicle->visitor_id = $visitor->id;
            $vehicle->save();
        }

        return response()->json(['success' => 'Returning visitor checked in successful'], 201);
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
