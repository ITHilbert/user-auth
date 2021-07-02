<?php

namespace App\Menu\Filters;

use JeroenNoten\LaravelAdminLte\Menu\Filters\FilterInterface;
use Laratrust\Laratrust;
use ITHilbert\UserAuth\Entities\Role;
use Illuminate\Support\Facades\Auth;
use App\User;

class hasPermission implements FilterInterface
{
    public function transform($item)
    {

        if (isset($item['hasPermission']) ) {
            $user =  Auth::user()->load('role');

            if( !$user->hasPermission($item['hasPermission']) ){
                return false;
            }
        }

        return $item;
    }


}
