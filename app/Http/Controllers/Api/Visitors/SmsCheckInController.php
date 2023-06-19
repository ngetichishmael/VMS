<?php

namespace App\Http\Controllers\Api\Visitors;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Nationality;
use App\Models\Premise;
use App\Models\Resident;
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
         $sentry=Sentry::where('phone_number', $request->user()->phone_number)->first();
        return response()->json(Visitor::with(['resident2', 'user_details', 'sentry', 'purpose', 'visitorType', 'timeLogs'])->where('sentry_id', $sentry->id )
            ->where('type', 'SMS')
            ->get());
    }
    public function smsUncheckout(Request $request)
    {
        $sentry=Sentry::where('phone_number', $request->user()->phone_number)->first();
        return response()->json(
            Visitor::with(['user_details','resident2', 'sentry', 'purpose', 'visitorType', 'timeLogs'])
                ->where('sentry_id', $sentry->id)
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
            return response()->json(['message' => 'visitor not found'], 404);
        }

        if ($timeLog->exit_time) {
            return response()->json(['message' => 'Visitor already checked out'], 400);
        }

        $timeLog->exit_time = now();
        $timeLog->save();

        return response()->json(['message' => 'Visitor checked out successfully']);
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
        $user_details = UserDetail::where(function ($query) {
            $query->whereNotNull('phone_number')
                ->where('phone_number', '!=', 0);
        })->where('phone_number', $request->input('phone1'))->first();
        if ($user_details) {
            $visitor = Visitor::where('user_detail_id', $user_details->id)->latest('id')->first();
            if ($visitor->status==1) {
                return response()->json(['error' => 'Visitor is in the blacklist, please contact Admin'], 409);
            }
            if ($visitor && $visitor->time_log_id) {
                $timeLog = TimeLog::find($visitor->time_log_id);

                if ($timeLog && $timeLog->exit_time === null) {
                    return response()->json(['error' => 'Visitor already signed in, to continue checkout then checkin'],409);
                }
            }
        }
        else
            $nationality = null;
         $nationality = Nationality::where('name', $request->input('nationality'))->first();

        if (!$nationality) {
            $nationality = new Nationality();
            $nationality->name = $request->input('nationality') ?? 'Kenya';
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
        $timeLog->entry_time = Carbon::now();
        $timeLog->save();
        $visitor->time_log_id = $timeLog->id;

        $user_details = UserDetail::where(function ($query) {
                $query->whereNotNull('phone_number')
                    ->where('phone_number', '!=', 0);
            })->where('phone_number', $request->input('phone1'))->first();

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
        $time = $timeLog->entry_time;

        if (($request->input('notify') !== null) && ($request->input('notify') == 1 || $request->input('notify') == 'true')) {
            $resident = Resident::where('id', $request->resident_id)->where('status', 1)->first();
            if ($resident != null || $resident != '') {

                $phone_number = $resident->phone_number;
                $resident_name = $resident->name;
                $premise = Premise::where('id', $detail->premise_id)->first();
                $place = $premise->name;
                $this->sendUserSMS( $time, $resident_name, $phone_number, $place);
                return response()->json(['success' => 'Visitor successfully checked in by SMS and ' . $resident_name . ' notified'], 201);
            }
        }
        Activity::create([
            'name' => $request->user()->name,
            'target' => "new Drive In created by " . $request->user()->name,
            'organization' => 'Visitor by' . $visitor->name,
            'activity' => "Created a new visitor with " . $visitor .
                'with details: ' . $user_details  . ' and vehicle ' . $vehicle

        ]);
        return response()->json(['success' => 'Visitor information added successfully.'], 201);
    }

    public function sendUserSMS($time, $resident_name, $phone_number, $place)
    {
        $curl = curl_init();
        $url = 'https://accounts.jambopay.com/auth/token';
        curl_setopt($curl, CURLOPT_URL, $url);

        curl_setopt(
            $curl,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/x-www-form-urlencoded',
            )
        );

        curl_setopt(
            $curl,
            CURLOPT_POSTFIELDS,
            http_build_query(
                array(
                    'grant_type' => 'client_credentials',
                    'client_id' => "qzuRm3UxXShEGUm2OHyFgHzkN1vTkG3kIVGN2z9TEBQ=",
                    'client_secret' => "36f74f2b-0911-47a5-a61b-20bae94dd3f1gK2G2cWfmWFsjuF5oL8+woPUyD2AbJWx24YGjRi0Jm8="
                )
            )
        );

        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $curl_response = curl_exec($curl);

        $token = json_decode($curl_response);
        curl_close($curl);

        $message = 'Hello ' . $resident_name . ', your visitor has arrived at ' . $place . ' Main Gate at ' . $time . '.';
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://swift.jambopay.co.ke/api/public/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode(
                array(
                    "sender_name" => "PASANDA",
                    "contact" => $phone_number,
                    "message" => $message,
                    "callback" => "https://pasanda.com/sms/callback"
                )
            ),

            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer ' . $token->access_token
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        //        return '$response';
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
