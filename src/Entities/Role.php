<?php

namespace ITHilbert\UserAuth\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use ITHilbert\LaravelKit\Traits\VueComboBox;
use ITHilbert\UserAuth\Entities\Permission;

class Role extends Model
{
    use SoftDeletes;
    use VueComboBox;

    protected $table = 'roles';
    //public $timestamps = false;
    //protected $fillable = [];

    public function getCbCaptionAttribute(){
        return $this->role_display;
    }


    public function permissions(){
        return $this->belongsToMany('ITHilbert\UserAuth\Entities\Permission', 'role_permission', 'role_id', 'permission_id');
    }

    /**
     * Prüft ob die Rolle eine bestimmte Permission hat
     *
     * @param string $permission
     * @return boolean
     */
    public function hasPermission($permission){
        $permission = $this->permissions->where('permission', $permission)->first();
        if($permission){
            return true;
        }
        return false;
    }

}
