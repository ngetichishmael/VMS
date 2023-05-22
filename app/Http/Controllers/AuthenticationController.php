<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class AuthenticationController extends Controller
{
    public function Login(Request $request)
    {
        $user = null;
        if (!Auth::attempt([
            'phone_number' => $request->phone_number, 'status' => '1', 'role_id'=> '1' | '2'
        ], true)) {
            return response()
                ->json(['message' => 'Unauthorized'], 401);
        }
        if ($user === null) {
            return response()
                ->json(['message' => 'Unauthorized'], 401);
        }
        $token = $user->createToken('auth_token')->plainTextToken;
//        $user->last_login_at = now();
//        $user->save();

        return response()->json([
            "success" => true,
            "token_type" => 'Bearer',
            "message" => "User Logged in",
            "access_token" => $token,
            "user" => $user
        ]);
    }
    public function login2(Request $request)
    {

        //(!Auth::attempt(['email' => $request->email, 'password' => $request->password], true))
        if (!Auth::attempt(
            [
                'email' => $request->email,
                'password' => $request->password,

            ],
            true
        )) {
            return response()
                ->json(['message' => 'Unauthorized'], 401);
        }

        $user = User::where('email', $request['email'])->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

//        $user->last_login_at = now();
//        $user->save();

        return response()->json([
            "success" => true,
            "token_type" => 'Bearer',
            "message" => "User Logged in",
            "access_token" => $token,
            "user" => $user
        ]);
    }
    // Login v1
    public function login_v1()
    {
        $pageConfigs = ['blankPage' => true];

        return view('/content/authentication/auth-login-v1', ['pageConfigs' => $pageConfigs]);
    }

    // Login v2
    public function login_v2()
    {
        $pageConfigs = ['blankPage' => true];

        return view('content.authentication.auth-login-v2', ['pageConfigs' => $pageConfigs]);
    }

    // Register v1
    public function register_v1()
    {
        $pageConfigs = ['blankPage' => true];

        return view('content.authentication.auth-register-v1', ['pageConfigs' => $pageConfigs]);
    }

    // Register v2
    public function register_v2()
    {
        $pageConfigs = ['blankPage' => true];

        return view('content.authentication.auth-register-v2', ['pageConfigs' => $pageConfigs]);
    }

    public function store_user(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }

    // Forgot Password v1
    public function forgot_password_v1()
    {
        $pageConfigs = ['blankPage' => true];

        return view('/content/authentication/auth-forgot-password-v1', ['pageConfigs' => $pageConfigs]);
    }

    // Forgot Password v2
    public function forgot_password_v2()
    {
        $pageConfigs = ['blankPage' => true];

        return view('/content/authentication/auth-forgot-password-v2', ['pageConfigs' => $pageConfigs]);
    }

    // Reset Password
    public function reset_password_v1()
    {
        $pageConfigs = ['blankPage' => true];

        return view('/content/authentication/auth-reset-password-v1', ['pageConfigs' => $pageConfigs]);
    }

    // Reset Password
    public function reset_password_v2()
    {
        $pageConfigs = ['blankPage' => true];

        return view('/content/authentication/auth-reset-password-v2', ['pageConfigs' => $pageConfigs]);
    }
}
