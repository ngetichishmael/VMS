<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Activity;
use App\Models\User;
use App\Models\UserCode;
use App\Models\ValidToken;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Notifications\LoginVerificationNotification;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();
        Activity::create([
            'name' => $request->user()->name,
            'target' => "Web Login",
            'organization' => $request->user()->organization_code,
            'activity' => "Logging in to the web application"
        ]);
        $request->user()->update(['last_login_at' => now()]);

        ValidToken::updateOrCreate(
            [
                'user_id' => $request->user()->id,
            ],
            [
                'email' => $request->user()->email,
                'is_valid_otp' => 0,
            ]
        );


        $request->user()->notify(new LoginVerificationNotification());

        return redirect()->to('/dashboard/otp');
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        ValidToken::where('user_id', $request->user()->id)->update(['is_valid_otp' => 0]);
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
