<?php

namespace App\Menu\Filters;

use JeroenNoten\LaravelAdminLte\Menu\Filters\FilterInterface;
use Illuminate\Support\Facades\Auth;

class hasPermissionAnd implements FilterInterface
{
    public function transform($item)
    {

        if (isset($item['hasPermissionAnd']) ) {
            if(!Auth::check()) return false;
            $user =  Auth::user();

            if( !$user->hasPermissionAnd($item['hasPermissionAnd']) ){
                return false;
            }
        }

        return $item;
    }


}
