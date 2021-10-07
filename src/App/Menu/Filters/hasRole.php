<?php

namespace App\Menu\Filters;

use JeroenNoten\LaravelAdminLte\Menu\Filters\FilterInterface;
use Illuminate\Support\Facades\Auth;

class hasRole implements FilterInterface
{
    public function transform($item)
    {

        if (isset($item['hasRole']) ) {
            if(!Auth::check()) return false;
            $user =  Auth::user();
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
