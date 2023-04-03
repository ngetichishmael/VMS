<?php

namespace App\Http\Middleware;

use App\Models\ValidToken;
use Closure;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;
use Illuminate\Support\Facades\Auth;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //
    ];
//    public function handle($request, Closure $next)
//    {
//        $user=Auth::user()->token;
//        session(['token' => $user]);
//        if (! $request->session()->exists('user') || $request->session()->has('user')) {
//            return $next($request);
//        }
//        return redirect('/login');
//    }


}
