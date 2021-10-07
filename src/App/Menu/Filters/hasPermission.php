<?php

namespace App\Menu\Filters;

use JeroenNoten\LaravelAdminLte\Menu\Filters\FilterInterface;
use Illuminate\Support\Facades\Auth;


class hasPermission implements FilterInterface
{
    public function transform($item)
    {

        if (isset($item['hasPermission']) ) {
            if(!Auth::check()) return false;
            $user =  Auth::user();

            if( !$user->hasPermission($item['hasPermission']) ){
                return false;
            }
        }

        return $item;
    }


}
