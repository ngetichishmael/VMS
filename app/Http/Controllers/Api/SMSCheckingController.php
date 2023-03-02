<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UserCode;
use Illuminate\Http\Request;

class SMSCheckingController extends Controller
{
    public function SMSChecking(Request $request, $phone_number)
    {
        $user_id = $request->user()->id;
        $user_code = rand(1000, 9999);
        UserCode::create([
            'user_id' => $user_id,
            'code' => $user_code
        ]);
        $this->sendUserSMS($user_code, $phone_number);
        return response()->json([
            "success" => true,
            'status' => 200,
            'message' => "User and Sentry verification codes"
        ]);
    }
    public function sendUserSMS($code, $phone_number)
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
        return $response;
    }
    public function verifyOTP(Request $request, $otp)
    {

        $exists = UserCode::where('user_id', $request->user()->id)
            ->where('code', $otp)
            ->where('updated_at', '>=', now()->subMinutes(5))
            ->latest('updated_at')
            ->exists();
        if ($exists) {
            return response()->json(['message' => 'Valid OTP entered'], 200);
        }
        return response()->json(['message' => 'Invalid OTP entered'], 406);
    }
}
