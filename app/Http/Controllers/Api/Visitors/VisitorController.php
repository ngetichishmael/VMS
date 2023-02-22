<?php

namespace App\Http\Controllers\Api\Visitors;

use App\Http\Controllers\Controller;
use App\Models\IdentificationType;
use App\Models\Purpose;
use App\Models\Resident;
use App\Models\Sentry;
use App\Models\TimeLog;
use App\Models\UserDetail;
use App\Models\Visitor;
use App\Models\VisitorType;
use Illuminate\Http\Request;
use App\Models\Organization;
use App\Models\Premise;

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
        $sentry = Sentry::where('user_detail_id', $request->user()->id)->first();
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
        return response()->json(Visitor::with(['resident2','sentry', 'purpose', 'vehicle', 'visitorType', 'timeLogs'])->where('sentry_id', $request->user()->id)->get());
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
        $user_details = UserDetail::find($request->phone_number);
        if ($user_details) {
            $result = TimeLog::whereId($user_details->id)->whereNull('exit_time')->update([
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
