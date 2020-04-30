<?php

namespace ITHilbert\UserAuth\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class hasRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        $user = User::find(Auth::id());
        //Admin und Superadmin  haben immer das Recht
        if($user->role_id <= 2){
            return $next($request);
        }
        //recht prüfen
        if($user->hasRole($role)){
            return $next($request);
        }

        return redirect()->route('no-permission');
    }
}
