<?php

namespace ITHilbert\UserAuth\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use ITHilbert\LaravelKit\Traits\VueComboBox;
use ITHilbert\UserAuth\Entities\Permission;

class PermissionGroup extends Model
{
    use SoftDeletes;
    use VueComboBox;

    protected $table = 'permissions_groups';
    //protected $fillable = [];

    //Variablen
    private $permission = array();

    public function permissionCreate(){
        if(!isset($this->permission['create'])){
            $this->permission['create'] = Permission::where('permission', $this->group_name . '_create' )->first();
        }
        return $this->permission['create'];
    }

    public function permissionRead(){
        if(!isset($this->permission['read'])){
            $this->permission['read'] = Permission::where('permission', $this->group_name . '_read' )->first();
        }
        return $this->permission['read'];
    }

    public function permissionEdit(){
        if(!isset($this->permission['edit'])){
            $this->permission['edit'] = Permission::where('permission', $this->group_name . '_edit' )->first();
        }
        return $this->permission['edit'];
    }

    public function permissionDelete(){
        if(!isset($this->permission['delete'])){
            $this->permission['delete'] = Permission::where('permission', $this->group_name . '_delete' )->first();
        }
        return $this->permission['delete'];
    }

    public function getCbCaptionAttribute(){
        return $this->group_display;
    }

    public function getPermisssions(){
        return Permission::where('group_id', $this->id)->where('deleted_at', NULL)->get();
    }

    public function getPermisssionsSingle(){
        return Permission::where('group_id', $this->id)->where('deleted_at', NULL)->where('crud', 'single')->orderBy('permission_display', 'ASC')->get();
    }


}
