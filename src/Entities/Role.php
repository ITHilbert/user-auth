<?php

namespace ITHilbert\UserAuth\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use ITHilbert\Vue\Traits\VueComboBox;

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
        //Admin darf immer
        if($this->role == 'dev' || $this->role == 'admin'){
            return true;
        }

        $permission = $this->permissions->where('permission', $permission)->first();
        if($permission){
            return true;
        }
        return false;
    }

    /**
     * Prüft ob die Rolle eine bestimmte Permission hat
     *
     * @param string $permission
     * @return boolean
     */
    public function hasPermissionOr($permissions){
        //Admin darf immer
        if($this->role == 'dev' || $this->role == 'admin'){
            return true;
        }

        $permission = explode(',', $permissions);

        foreach( $permission as $perm) {
            $check = $this->permissions->where('permission', trim($perm) )->first();
            if($check){
                return true;
            }
        }
        return false;
    }

    /**
     * Prüft ob die Rolle eine bestimmte Permission hat
     *
     * @param string $permission
     * @return boolean
     */
    public function hasPermissionAnd($permissions){
        //Admin darf immer
        if($this->role == 'dev' || $this->role == 'admin'){
            return true;
        }

        $permission = explode(',', $permissions);

        foreach( $permission as $perm) {
            $check = $this->permissions->where('permission', trim($perm))->first();
            if(!$check){
                return false;
            }
        }
        return true;
    }

}
