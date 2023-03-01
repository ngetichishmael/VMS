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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DriveInController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {

        return response()->json(
            Visitor::with(
                [
                    'resident2',
                    'sentry',
                    'vehicle',
                    'purpose',
                    'visitorType',
                    'timeLogs'
                ]
            )->where('sentry_id', $request->user()->id)
                ->where('type', 'drivein')
                ->get()
        );
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'type' => 'required|string',
            'visitor_type_id' => 'required|integer',
            'purpose_id' => 'required|integer',
            'nationality' => 'required|string',
            'resident_id' => 'required|integer',
            'IDNO' => 'required|numeric',
            'registration' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $user_details = UserDetail::where('ID_number', $request->input('IDNO'))
            ->orWhere('phone_number', $request->input('phone1'))
            ->first();
        $visitor = Visitor::where('user_detail_id', $user_details->id)->latest('id')->first();

        if ($visitor && $visitor->time_log_id) {
            $timeLog = TimeLog::find($visitor->time_log_id);

            if ($timeLog && $timeLog->exit_time === null) {
                return response()->json(['error' => 'User already signed in, If its by mistake, Sign the user out first to sign back in']);
            }
        }

        $nationality = Nationality::find($request->nationality);

        if (!$nationality){
            $nationality = new Nationality();
            $nationality->name = $request->input('nationality') ?? '101';
            $nationality->save();
        }

        $timeLog = new TimeLog;
        $now = Carbon::now();
        $nairobiNow = $now->setTimezone('Africa/Nairobi');
        $timeLog->entry_time = $nairobiNow->format('Y-m-d H:i:s');
//        $timeLog->entry_time = now();
        $timeLog->save();

        $visitor = new Visitor();
        $visitor->name = $request->input('name');
        $visitor->type = $request->input('type');
        $visitor->identification_type_id = $request->input('identification_type_id');
        $visitor->visitor_type_id = $request->input('visitor_type_id');
        $visitor->purpose_id = $request->input('purpose_id');
        $visitor->sentry_id = $request->user()->id;
        $visitor->nationality_id = $nationality->id ?? "110";
        $visitor->resident_id = $request->input('resident_id');
        $visitor->tag = $request->input('tag');

        if ($request->hasFile('attachment1')) {
            $visitor->attachment1 = $request->attachment1->store('public/attachments');
        }

        if ($request->hasFile('attachment2')) {
            $visitor->attachment2 = $request->attachment2->store('public/attachments');
        }

        if ($request->hasFile('attachment3')) {
            $visitor->attachment3 = $request->attachment3->store('public/attachments');
        }

        if ($request->hasFile('attachment4')) {
            $visitor->attachment4 = $request->attachment4->store('public/attachments');
        }

        $visitor->time_log_id = $timeLog->id;

        $user_details = UserDetail::where('ID_number', $request->input('IDNO'))
            ->orWhere('phone_number', $request->input('phone1'))
            ->first();
        if (!$user_details) {
            $user_details = new UserDetail();
            $user_details->phone_number = $request->input('phone1');
            $user_details->secondary_phone_number = $request->input('phone2');
            $user_details->date_of_birth = $request->input('DOB');
            $user_details->ID_number = $request->input('IDNO');
            $user_details->gender = $request->input('gender');
            $user_details->company = $request->input('company');
            if ($request->hasFile('image')) {
                $visitor->image = $request->image->store('public/id_images');
            }
            $user_details->save();
        }
        $visitor->user_detail_id = $user_details->id;
        $visitor->save();

        $vehicle = new VehicleInformation();
        $vehicle->registration = $request->input('registration');
        $vehicle->visitor_id = $visitor->id;
        $vehicle->save();

        return response()->json(['success' => 'Visitor and vehicle information added successfully.'], 201);
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
