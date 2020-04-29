<?php

namespace ITHilbert\UserAuth\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class hasPermissionOr
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $permissions)
    {
        $user = User::find(Auth::id());
        foreach ($permissions as $permission) {
            if($user->hasPermission($permission)){
                return $next($request);
            }
        }
        return redirect()->route('no-permission');

    }
}
