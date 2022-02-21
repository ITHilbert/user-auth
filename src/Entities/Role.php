<?php

namespace ITHilbert\UserAuth\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use ITHilbert\LaravelKit\Traits\VueComboBox;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class Role extends Model
{
    use SoftDeletes;
    use VueComboBox;

    protected $table = 'roles';
    //public $timestamps = false;
    //protected $fillable = [];

    private $permissions = array();

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

        $this->loadPermissions();
        return in_array($permission, $this->permissions);
    }

    /**
     * Prüft ob die Rolle eine bestimmte Permission hat
     *
     * @param string $permission
     * @return boolean
     */
    public function hasPermissionInView($permission){
        $permission = $this->permissions()->where('permission', $permission)->first();
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
                            ->where('role_id' , '=' , $this->id)
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

}
