<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    public function Login(Request $request)
    {

        $user = User::where('phone_number', $request->phone_number)->where('status',1)->first();;
        if (!$user) {
            return response()
                ->json(['message' => 'Unauthorized'], 401);
        }
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            "success" => true,
            "token_type" => 'Bearer',
            "message" => "User Logged in",
            "access_token" => $token,
            "user" => $user
        ]);
    }
}
