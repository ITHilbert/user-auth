<?php

namespace App\Menu\Filters;

use JeroenNoten\LaravelAdminLte\Menu\Filters\FilterInterface;
use Laratrust\Laratrust;
use ITHilbert\UserAuth\Entities\Role;
use Illuminate\Support\Facades\Auth;
use App\User;

class hasPermissionOr implements FilterInterface
{
    public function transform($item)
    {
        if (isset($item['hasPermissionOr']) ) {
            $user =  Auth::user()->load('role');

            if( !$user->hasPermissionOr($item['hasPermissionOr']) ){
                return false;
            }
        }

        return $item;
    }


}
