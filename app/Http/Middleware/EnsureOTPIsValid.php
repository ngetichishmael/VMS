<?php

namespace App\Http\Middleware;

use App\Models\ValidToken;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureOTPIsValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect('login');
        }
        $valid = ValidToken::where('user_id', $request->user()->id)->where('is_valid_otp', 1)->first();
        if (!$valid) {
            return redirect('/dashboard/otp');
        }
        return $next($request);
    }
}
