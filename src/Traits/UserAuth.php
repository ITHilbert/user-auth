<?php

namespace ITHilbert\UserAuth\Traits;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use ITHilbert\Vue\Traits\VueComboBox;
use Modules\Userauth\Entities\Role;

trait UserAuth
{
    use SoftDeletes;
    use VueComboBox;

    public function getCbCaptionAttribute(){
        return $this->name;
    }

    public function __construct() {
        $this->fillable[] = 'role_id';
        $this->fillable[] = 'firstname';
        $this->fillable[] = 'lastname';
        $this->fillable[] = 'smallname';
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

    /**
     * Prüft ob der User eine bestimmte Rolle hat
     *
     * @param string|int|array| $roles
     * @return bool
     */
    public function hasRole($roles): bool
    {
        $roleArray = array();
        $rolename = $this->role->role;
        $roleID = $this->role_id;

        if (is_string($roles) && false !== strpos($roles, '|')) {
            $roleArray = $this->convertPipeToArray($roles);
        }elseif (is_string($roles)|| is_int($roles)) {
            $roleArray[] = trim($roles);
        }else{
            return false;
        }

        foreach ($roleArray as $role) {
            if(is_string($role) && $role == $rolename){
                return true;
            }elseif(is_int($role) && $role == $roleID){
                return true;
            }
        }

        //kein Treffer
        return false;
    }

    public function roleDisplayname(){
        return $this->role->role_display;
    }

    public function hasPermission($permission){
        return $this->role->hasPermission($permission);
    }

    public function hasPermissionOr($permissions){
        return $this->role->hasPermissionOr($permissions);
    }

    public function hasPermissionAnd($permissions){
        return $this->role->hasPermissionAnd($permissions);
    }

    //Helper
    protected function convertPipeToArray(string $pipeString)
    {
        $pipeString = trim($pipeString);

        if (strlen($pipeString) <= 2) {
            return $pipeString;
        }

        $quoteCharacter = substr($pipeString, 0, 1);
        $endCharacter = substr($quoteCharacter, -1, 1);

        if ($quoteCharacter !== $endCharacter) {
            return explode('|', $pipeString);
        }

        if (! in_array($quoteCharacter, ["'", '"'])) {
            return explode('|', $pipeString);
        }

        return explode('|', trim($pipeString, $quoteCharacter));
    }


}
