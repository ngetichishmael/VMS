<?php

namespace App\Http\Controllers\Api\Visitors;

use App\Http\Controllers\Controller;
use App\Models\Activity;
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
        $detail = UserDetail::where('phone_number', $request->user()->phone_number)->first();
        $sentry = Sentry::where('user_detail_id', $detail->id)->first();
        //        return response()->json($detail->id);
        if (!$sentry) {
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
    public function verifyPhoneNumberUser(Request $request)
    {
        $phone_number = $request->input('phone_number');
        $user = UserDetail::where('phone_number', $phone_number)->first();

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

        $users = UserDetail::whereRaw("REPLACE(phone_number, '-', '') LIKE '%$stripped_number%'")
            ->orWhere('ID_number', 'LIKE', "%$number%")
            ->orWhere('phone_number', 'LIKE', "%$number%")
            ->get();

        if ($users->isEmpty()) {
            return response()->json(['message' => 'Visitor not found'], 404);
        }

        $visitor = Visitor::whereIn('user_detail_id', $users->pluck('id')->toArray())
            ->orderBy('id', 'desc')
            ->first();
        $time_log = TimeLog::where('id', $visitor->time_log_id)
            ->whereNull('exit_time')
            ->first();
        if ($time_log) {
            return response()->json(['message' => 'User has already checked in'], 409);
        }
        if ($visitor->type === 'DriveIn') {
            $visitor->vehicle = VehicleInformation::where('visitor_id', $visitor->id)->first();
            return response()->json(['message' => 'Visitor exists and has Vehicle details', 'visitor' => $visitor], 200);
        }

        return response()->json(['message' => 'Visitor exists', 'visitor' => $visitor], 200);
    }



    //    public function returningVisitorVerify(Request $request)
    //    {
    //        $number = $request->input('number');
    //        $stripped_number = preg_replace('/[^0-9]/', '', $number);
    //        $user = UserDetail::whereRaw("REPLACE(phone_number, '-', '') LIKE '%$stripped_number'")
    //            ->orwhere('ID_number', $number)->orwhere('phone_number', $number)->first();
    //        //$user = UserDetail::where('ID_number', $number)->orWhere('phone_number', $number)->first();
    //
    //        if (!$user) {
    //            return response()->json(['message' => 'Visitor not found'], 404);
    //        }
    //
    //        $visitor = Visitor::where('user_detail_id',  $user->id)->orderBy('id', 'desc')->first();
    //        $time_log = TimeLog::where('id', $visitor->time_log_id)
    //            ->whereNull('exit_time')
    //            ->first();
    //        if ($time_log) {
    //            return response()->json(['message' => 'User has already checked in'], 400);
    //        }
    //        if ($visitor->type === 'DriveIn') {
    //            $visitor->vehicle = VehicleInformation::where('visitor_id', $visitor->id)->first();
    //            return response()->json(['Message' => 'Visitor exists and has a Vehicle details', 'visitor' => $visitor], 200);
    //        }
    //
    //        return response()->json(['Message' => 'Visitor exists', 'visitor' => $visitor], 200);
    //    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {

//        $now = Carbon::now();
//        $nairobiNow = $now->setTimezone('Africa/Nairobi');
//        $timeLog->entry_time = $nairobiNow->format('Y-m-d H:i:s');

        $nationality = Nationality::find($request->nationality);
        if (!$nationality){
            $nationality = new Nationality();
            $nationality->name = $request->input('nationality') ?? '101';
            $nationality->save();
        }

        $detail=Sentry::where('phone_number', $request->user()->phone_number ?? '')->first();

        $visitor = new Visitor();
        $visitor->name = $request->input('name');
        $visitor->type = $request->input('type');
        //        $visitor->identification_type_id = $request->input('identification_type_id');
        $visitor->visitor_type_id = $request->input('visitor_type_id');
        $visitor->purpose_id = $request->input('purpose_id');
        $visitor->sentry_id = $detail->id;
        $visitor->nationality_id = $nationality->id ?? "101";
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
        $time=$timeLog->entry_time;
        $visitor->time_log_id = $timeLog->id;
        $visitor->user_detail_id = $request->input('user_detail_id');
        $visitor->save();
        if ($request->registration !== null) {
            $vehicle = new VehicleInformation();
            $vehicle->registration = $request->registration;
            $vehicle->visitor_id = $visitor->id;
            $vehicle->save();
        }
        $visitor_name=$request->input('name');
        Activity::create([
            'name' => $request->user()->name,
            'target' => "new Drive In created by " . $request->user()->name,
            'organization' => '' . $visitor->name,
            'activity' => "Created a new visitor with " . $visitor . ' with vehicle ' . $vehicle ?? "Visit did not come with vehicle"
        ]);

        if (($request->input('notify')!==null) && ($request->input('notify')==1 || $request->input('notify')=='true')) {
            $resident =Resident::where('id', $request->resident_id)->where('status', 1)->first();
            if ($resident!=null || $resident!='') {

                $phone_number=$resident->phone_number ?? ' ';
                $resident_name=$resident->name ?? ' ';
                $premise=Premise::where('id',$detail->premise_id)->first();
                $place=$premise->name ?? ' ';
                $this->sendUserSMS($visitor_name, $time, $resident_name, $phone_number, $place);
                return response()->json(['success' => 'Returning visitor checked in successful and '.$resident_name .' notified' ], 201);

            }
        }

        return response()->json(['success' => 'Returning visitor checked in successful.'], 201);
    }

    public function sendUserSMS($visitor_name, $time, $resident_name, $phone_number, $place)
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

        $message ='Hello ' . $resident_name . ', a visitor by the name '. $visitor_name .', has arrived at '. $place .' Main Gate at ' .$time .'.';
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
