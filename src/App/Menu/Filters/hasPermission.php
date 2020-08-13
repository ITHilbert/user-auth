<?php

namespace App\Menu\Filters;

use JeroenNoten\LaravelAdminLte\Menu\Builder;
use JeroenNoten\LaravelAdminLte\Menu\Filters\FilterInterface;
use ITHilbert\UserAuth\Entities\Role;
use Illuminate\Support\Facades\Auth;
use App\User;

class hasPermission implements FilterInterface
{
    public function transform($item, Builder $builder)
    {

        if (isset($item['hasPermission']) ) {
            $user =  User::find(Auth::id());

            if( !$user->hasPermission($item['hasPermission']) ){
                return false;
            }
        }

        return $item;
    }


}
