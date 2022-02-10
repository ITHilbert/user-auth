<?php

namespace ITHilbert\UserAuth\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class hasPermissionAnd
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
        //Admin und Developer  haben immer das Recht
        if($user->role_id <= 2){
            return $next($request);
        }
        //recht prüfen
        foreach ($permissions as $permission) {
            if(!$user->hasPermission($permission)){
                return redirect()->route('no-permission', [$request, $user->id]);
            }
        }

        return $next($request);
    }
}
