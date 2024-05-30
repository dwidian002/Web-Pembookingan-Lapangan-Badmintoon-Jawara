<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        if (Auth::guard('admin')->check()) {
            return route('/admin');
        } elseif (Auth::guard('pelanggan')->check()){
            return route('booking.list');
        }
    }
}
