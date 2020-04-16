<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use App\User;
use JWTAuth;
use Response;

use Closure;

class CheckLevelPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // if (! $request->user()->hasRole($role)) {
        //     // Redirect...
        // }
        $user = JWTAuth::toUser($request->token);
        // error_log("user:".Auth::guard()->user());
        if($user->level == 1) {
            return $next($request);
        } else {
            return response()->json('Not authorized', 403);
        }
    }
}
