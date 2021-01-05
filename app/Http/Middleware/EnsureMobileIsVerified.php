<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;
use Modules\User\Space\Contracts\MustVerifyPhone;

class EnsureMobileIsVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        $user = $request->user();

        if (
            $user &&
            ($user instanceof MustVerifyPhone &&
                !$user->hasVerifiedPhone())
        ) {

            Auth::guard('web')->logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();

            return $request->expectsJson()
                ? abort(403, 'Your email address is not verified.')
                : redirect()->route('user.home');
        }

        return $next($request);
    }
}
