<?php

namespace App\Menu\Filters;

use JeroenNoten\LaravelAdminLte\Menu\Filters\FilterInterface;
use Laratrust\Laratrust;
use ITHilbert\UserAuth\Entities\Role;
use Illuminate\Support\Facades\Auth;
use App\User;

class hasRole implements FilterInterface
{
    public function transform($item)
    {

        if (isset($item['hasRole']) ) {
            $user =  Auth::user()->load('role');
            $role =  $item['hasRole'];

            //Ausnahmen Admin und Developer
            if( $user->role_id == 1 || $user->role_id == 2 && $role != 'dev'){
                return $item;
            }

            if($item['hasRole'] != $user->roleName() ){
                return false;
            }
        }

        return $item;
    }
}
