<?php

namespace ITHilbert\UserAuth\Traits;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Userauth\Entities\Role;

trait UserAuth
{
    use SoftDeletes;

    public function __construct() {
        $this->fillable[] = 'role_id';
    }

    public function getKey(){
        return $this->id;
    }

    public function role(){
        return $this->hasOne('ITHilbert\UserAuth\Entities\Role', 'id', 'role_id');
    }

    public function roleName(){
        return $this->role->role;
    }

    public function roleDisplayname(){
        return $this->role->role_display;
    }

    public function hasPermission($permission){
        return $this->role->hasPermission($permission);
    }

}
