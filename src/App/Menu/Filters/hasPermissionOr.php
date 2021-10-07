<?php

namespace App\Menu\Filters;

use JeroenNoten\LaravelAdminLte\Menu\Filters\FilterInterface;
use Illuminate\Support\Facades\Auth;

class hasPermissionOr implements FilterInterface
{
    public function transform($item)
    {
        if (isset($item['hasPermissionOr']) ) {
            if(!Auth::check()) return false;
            $user =  Auth::user();

            if( !$user->hasPermissionOr($item['hasPermissionOr']) ){
                return false;
            }
        }

        return $item;
    }


}
