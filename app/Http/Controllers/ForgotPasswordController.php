<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;


class ForgotPasswordController extends Controller
{
    public function index()
    {
        
        $pageConfigs = ['blankPage' => true];

        return view('forgotpassword', ['pageConfigs' => $pageConfigs]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $response = $this->broker()->sendResetLink(
            $request->only('email')
        );

      
        return $response == Password::RESET_LINK_SENT
            ? redirect()->route('Forgot')->with('status', trans($response))->with('message', 'Reset link has been sent to your email.')
            : redirect()->back()->withErrors(['email' => trans($response)])->with('message', 'Failed to send password reset link.');
        
    }

    public function showResetPasswordForm(Request $request)
    {
        $pageConfigs = ['blankPage' => true];

        return view('reset_password', [
            'token' => $request->token,
            'email' => $request->email,
            'pageConfigs' => $pageConfigs
        ]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);
    
        $response = $this->broker()->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->password = Hash::make($password);
                $user->save();
            }
        );
    
        if ($response == Password::PASSWORD_RESET) {
            return redirect()->route('login')->with('status', 'Password updated successful.');
        } else {
            return redirect()->back()->withErrors(['email' => trans($response)]);
        }
    }
    
    

    private function broker()
    {
        return Password::broker();
    }
}
