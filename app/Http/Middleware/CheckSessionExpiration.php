<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use RuntimeException;

class CheckSessionExpiration
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        if (!$request->session()) {
            throw new RuntimeException('Session store not set on request.');
        }
        if ($request->session()->has('last_activity')) {
            $last_activity = $request->session()->get('last_activity');
            $timeout = config('session.lifetime') * 60;

            if (time() - $last_activity > $timeout) {
                $request->session()->forget('last_activity');
                return redirect()->route('/')->with('message', 'Your session has expired. Please log in again.');
            }
        }

        $request->session()->put('last_activity', time());

        return $next($request);
    }

}
