<?php

namespace App\Menu\Filters;

use JeroenNoten\LaravelAdminLte\Menu\Filters\FilterInterface;
use Laratrust\Laratrust;
use ITHilbert\UserAuth\Entities\Role;
use Illuminate\Support\Facades\Auth;
use App\User;

class hasPermissionAnd implements FilterInterface
{
    public function transform($item)
    {

        if (isset($item['hasPermissionAnd']) ) {
            $user =  Auth::user()->load('role');

            if( !$user->hasPermissionAnd($item['hasPermissionAnd']) ){
                return false;
            }
        }

        return $item;
    }


}
