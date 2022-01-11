<?php

namespace ITHilbert\UserAuth\Traits;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use ITHilbert\LaravelKit\Traits\VueComboBox;

trait UserAuth
{
    use SoftDeletes;
    use VueComboBox;

    private $permissions = array();
    private $role_name = '';

    public function getCbCaptionAttribute(){
        return $this->name;
    }

    public function __construct() {
        $this->fillable[] = 'role_id';
        $this->fillable[] = 'anrede_id';
        $this->fillable[] = 'title';
        $this->fillable[] = 'firstname';
        $this->fillable[] = 'lastname';
        $this->fillable[] = 'smallname';
        $this->fillable[] = 'street';
        $this->fillable[] = 'postcode';
        $this->fillable[] = 'city';
        $this->fillable[] = 'country';
        $this->fillable[] = 'signature_rule_id';
        $this->fillable[] = 'ustid';
        $this->fillable[] = 'phone';
        $this->fillable[] = 'phone2';
        $this->fillable[] = 'mobile';
        $this->fillable[] = 'fax';
        $this->fillable[] = 'private_email';
        $this->fillable[] = 'skype';
        $this->fillable[] = 'hourly_rate';
        $this->fillable[] = 'birthday';
        $this->fillable[] = 'comment';
    }

    public function getKey(){
        return $this->id;
    }

    public function role(){
        return $this->hasOne('ITHilbert\UserAuth\Entities\Role', 'id', 'role_id');
    }

    public function roleName(){
        if( $this->role_name == ''){
            //Prüfen ob werte bereits in der Session gespeichert sind
            if( Session::has('role_name') ){
                //Werte aus der Session holen
                $this->role_name = Session::get('role_name');
            }else{
                $this->role_name = $this->role->role;
                Session::put('role_name', $this->role_name);
            }
        }

        //dd(session('role_name'));
        return $this->role_name;
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


    /**
     * Prüft ob die Rolle eine bestimmte Permission hat
     *
     * @param string $permission
     * @return boolean
     */
    public function hasPermission(string $permission){
        //Admin darf immer
        if($this->role_id <= 2){
            return true;
        }

        $this->loadPermissions();
        return in_array($permission, $this->permissions);
    }


    /**
     * Prüft ob die Rolle eine bestimmte Permission hat
     *
     * @param string $permission
     * @return boolean
     */
    public function hasPermissionOr($permissions){
        //Admin darf immer
        if($this->role_id <= 2){
            return true;
        }

        $this->loadPermissions();
        $permission = explode(',', $permissions);

        foreach( $permission as $perm) {
            if( in_array(trim($perm), $this->permissions)){
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
        if($this->role_id <=2){
            return true;
        }

        $this->loadPermissions();
        $permission = explode(',', $permissions);

        foreach( $permission as $perm) {
            if(!in_array(trim($perm), $this->permissions)){
                return false;
            }
        }

        return true;
    }

    /**
     * Lädt die Persissions in die $permissions Variable
     *
     * @param boolean $force    true wenn auf jeden Fall die permissions neu geladen werden sollen
     * @return void
    */
    private function loadPermissions($force = false){
        //Daten auf jeden fall neu Laden
        if($force == true){
            //Daten Laden
            $result = DB::table('permissions')
                            ->join('role_permission', 'id', '=', 'permission_id')
                            ->where('role_id' , '=' , $this->role_id)
                            ->get();

            //Ergebnisse in der Variablen speichern
            foreach( $result as $row){
                $this->permissions[] = $row->permission;
            }

            //Ergebnisse in der Session speichern
            Session::put('permissions' , $this->permissions);

            return true;
        }

        //Prüfen ob die Variable noch leer ist
        if(count($this->permissions) == 0){
            //Prüfen ob werte bereits in der Session gespeichert sind
            if( Session::has('permissions') ){
                //Werte aus der Session holen
                $this->permissions = Session::get('permissions');
            }else{
                //Daten Laden
                $result = DB::table('permissions')
                            ->join('role_permission', 'id', '=', 'permission_id')
                            ->where('role_id' , '=' , $this->role_id)
                            ->get();

                //Ergebnisse in der Variablen speichern
                foreach( $result as $row){
                    $this->permissions[] = $row->permission;
                }

                //Ergebnisse in der Session speichern
                Session::put('permissions' , $this->permissions);
            }
        }
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
