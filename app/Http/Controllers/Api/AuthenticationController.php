<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Field;
use App\Models\Premise;
use App\Models\Sentry;
use App\Models\Setting;
use App\Models\User;
use App\Models\UserCode;

use App\Models\UserDetail;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthenticationController extends Controller
{
    public function Login(Request $request)
    {
        $user = User::where('phone_number', $request->phone_number)->where('role_id', '4')->first();
        if (!$user) {
            return response()
                ->json(['message' => 'Unauthorized'], 401);
        }
        if ($user->status === 0){
            return response()
                ->json(['message' => 'Account suspended, Please contact Admin'], 401);
        }
        if ($user === null) {
            return response()
                ->json(
                    [
                        'message' => 'Unauthorized',
                        'phone_number' => $request->phone_number
                    ],
                    401
                );
        }
        if ($user->status === 0) {
            return response()
                ->json(['message' => 'Account suspended, Please contact Admin'], 401);
        }
        $detail = UserDetail::where('phone_number', $user->phone_number)->first();
        $sentryid = Sentry::where('user_detail_id', $detail->id ?? '')->first();
        $premise = Premise::where('id', $sentryid->premise_id ?? '')->first();
        $user_code=UserCode::all()->pluck("code")->toArray();
        $code = rand(100000, 999999);

        while(in_array($code, $user_code)){
            $code = rand(100000, 999999);
        }
        $tokenUser = $user->createToken('auth_token')->plainTextToken;
        UserCode::updateOrCreate([
            'user_id' => $user->id,
            'code' => $code
        ]);
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

        $message = 'Your verification code is ' . $code;

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
                    "contact" => $request->phone_number,
                    "message" => $message,
                    "callback" => "https://pasanda.com/sms/callback"
                )
            ),

            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer ' . $token->access_token
            ),
        ));
        $responsePassanda = curl_exec($curl);
        curl_close($curl);
//        $detail = UserDetail::where('phone_number', $user->phone_number)->first();
//        $sentryid = Sentry::where('user_detail_id', $detail->id ?? '')->first();
//        $premise = Premise::where('id', $sentryid->premise_id ?? '')->first();
        $detail = Sentry::where('phone_number', $user->phone_number ?? '')->first();
        $premise = Premise::where('id', $detail->premise_id ?? 'premises')->first();
        Activity::create([
            'name' => $detail->name,
            'target' => " Mobile App",
            'organization' =>$premise->organization->code ?? ' ',
            'activity' => "User Logged in"

        ]);
        $user->last_login_at = now();
        $user->save();
        return response()->json([
            "success" => true,
            "token_type" => 'Bearer',
            "message" => "User Logged in",
            "premises" => $premise->name ?? ' ',
            "premises_id" => $premise->id ?? ' ',
            'organization' => $premise->organization->name ?? ' ',
            "access_token" => $tokenUser,
            "user" => $user,
            "code" => $code,
            "response" => $responsePassanda,
        ]);
    }

    /**
     * verify otp
     *
     * @return \Illuminate\Http\JsonResponse()
     */
    public function verifyOTP($number, $otp)
    {
        $exists = UserCode::where('code', $otp)
            ->where('updated_at', '>=', now()->subMinutes(5))
            ->latest('updated_at')
            ->first();
        $user = DB::table('users')->where('id', $exists->user_id)->first();
        if ($user) {
            return response()->json(
                [
                    'message' => 'Valid OTP entered'
                ],
                200
            );
        }
        return response()->json(['message' => 'Invalid OTP entered'], 406);
    }
    public function settings()
    {
        $user = auth()->user();
        $detail = Sentry::where('phone_number', $user->phone_number ?? '')->first();
        $premise = Premise::where('id', $detail->premise_id ?? 'premises')->first();
        $settings = Setting::where('organization_code', $premise->organization->code ?? 'not found')->first();
        return response()->json(['settings' => $settings ?? 'No Subscription settings found or user not logged in'], 200);
    }
    public function fields()
    {
        $user = auth()->user();
        $detail = Sentry::where('phone_number', $user->phone_number ?? '')->first();
        $premise = Premise::where('id', $detail->premise_id ?? 'premises')->first();
        $settings = Setting::where('organization_code', $premise->organization->code ?? 'not found')->first();

        $fields = Field::where('id', $settings->field_id ?? 'not found')->first();

        return response()->json(['fields' => $fields ?? 'No Fields found or user not logged in'], 200);
    }
}
