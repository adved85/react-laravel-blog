<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

use Illuminate\Auth\AuthenticationException;

use function PHPUnit\Framework\returnSelf;

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
        'current_password',
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
        $this->renderable( function(Throwable $e, $request) {
            return $this->handleAuthenticationException($e, $request);
        });
    }


    public function handleAuthenticationException(AuthenticationException $e, $request)
    {
        if($request->expectsJson()) {
            return response()->json(['state' => 0, 'message' => 'Unauthenticated. Exception Handler'], 401);
        }
        return redirect()->guest(route('auth.login'));
    }
}
