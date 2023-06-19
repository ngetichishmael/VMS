<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Session\TokenMismatchException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
    {
        // Handle TokenMismatchException (419 error)
        if ($exception instanceof TokenMismatchException) {
            return redirect()->route('login')->withErrors(['message' => 'Session expired. Please log in again.']);
        }

        // Handle AuthenticationException (if needed)
        if ($exception instanceof AuthenticationException) {
            return redirect()->route('login')->withErrors(['message' => 'Authentication failed. Please log in again.']);
        }

        return parent::render($request, $exception);
    }
}
