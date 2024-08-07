<?php

namespace App\Http\Middleware;

// use Illuminate\Contracts\Auth\Guard;

// Import
// use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        //
    ];

    // protected $auth;

    // public function __construct(Guard $auth)
    // {
    //     $this->auth = $auth;
    // }

    // protected function tokenMismatchResponse($request)
    // {
    //     // $this->auth->logout();
    //     // Auth::logout();
    //     Auth::guard('web')->logout();

    //     return redirect()->route('login')->withErrors(['message' => 'Your session has expired. Please log in again.']);
    // }
}
