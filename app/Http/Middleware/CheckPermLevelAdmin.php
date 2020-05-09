<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use App\User;
use JWTAuth;
use Response;

use Closure;

class CheckPermLevelAdmin
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
        $user = JWTAuth::toUser($request->token);
        if($user->level >= 3) {
            return $next($request);
        } else {
            return response()->json('Not authorized', 403);
        }
    }
}
