<?php

namespace ITHilbert\UserAuth\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Yajra\DataTables\Facades\DataTables;

use ITHilbert\LaravelKit\Helpers\HButton;
use ITHilbert\UserAuth\Entities\Permission;
use ITHilbert\UserAuth\Entities\PermissionGroup;
use ITHilbert\UserAuth\Entities\Role;

class RoleController extends Controller
{

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request)
    {
        $data = Role::latest()->where('deleted_at', NULL)->get();

        if ($request->ajax()) {
            $user = Auth::user();
            return Datatables::of($data)
                    /* ->addIndexColumn() */
 /*                    ->addColumn('cname', function($row){
                            return $row->getName();
                    }) */
                    ->addColumn('action', function($row) use ($user) {
                        $ausgabe = '<div style="white-space: nowrap;">';
                        if($row->id > 2){
                            //$ausgabe .= HButton::show(route('permission.show', $row->id), '');
                            if($user->hasPermission('role_edit')){
                                $ausgabe .= HButton::edit(route('role.edit', $row->id), '');
                            }
                            if($user->hasPermission('role_delete')){
                                $ausgabe .= HButton::delete($row->id, '');
                            }
                        }
                        $ausgabe .= '</div>';

                        return $ausgabe;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('userauth::role.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()    {
        $permissionsgroups = PermissionGroup::all();
        //$permissionsgroups1 = PermissionGroup::where('deleted_at', null)->where('is_group', 0)->get();
        //$permissionsgroups2 = PermissionGroup::where('deleted_at', null)->where('is_group', 1)->get();

        return view('userauth::role.create')->with(compact('permissionsgroups'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'role_display' => 'required | unique:roles',
        ]);

        $rol = $request->role_display;

        $role = new Role();
        $role->role_display = $rol;

        $prol = strtolower( str_replace(' ','', $role));
        $role->role = $rol;
        $role->save();

        //Rechte speichern
        if(isset($request->permission)){
            foreach($request->permission as $permID){
                $perm = Permission::find($permID);
                $role->permissions()->save($perm);
            }
        }

        if($role){
            return redirect()->route('role.index')->with([
                'message'    => Lang::get('userauth::role.MsgAddSuccess'),
                'alert-type' => 'success',
            ]);
        }else{
            return redirect()->back();
        }
    }


    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $permissionsgroups = PermissionGroup::all();

        return view('userauth::role.edit')->with(compact('role', 'permissionsgroups'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //Rolle finden
        $role = Role::find($id);

        //Prüfen ob Eingaben korrekt sind
        if($role->role_display != $request->role_display || $request->role_display == ''){
            $request->validate([
                'role_display' => 'required | unique:roles',
            ]);
        }

        //Rolenname setzen
        $role->role_display = $request->role_display;
        $role->role = strtolower( str_replace(' ','', $request->role_display));
        $erg = $role->update();

        //Rechte speichern
        $role->permissions()->detach(); //Bestehende Rechte löschen
        //Rechte neu setzen
        if(isset($request->permission)){
            foreach($request->permission as $permID){
                $perm = Permission::find($permID);
                $role->permissions()->save($perm);
            }
        }

        //return redirect()->route('role.index')->with([ 'success' => Lang::get('userauth::role.MsgEditSuccess')]);


        return redirect()->route('role.index')->with(['message'    => Lang::get('userauth::role.MsgEditSuccess') ]);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function delete($id)
    {
        if( $id < 3){
            return redirect()->route('role.index')->withErrors( Lang::get('userauth::role.MsgDeleteRoot'));
        }

        $role = Role::findOrFail($id);
        $role->delete();
        return redirect()->route('role.index')->with([
            'message'    => Lang::get('userauth::role.MsgDeleteSuccess'),
            'alert-type' => 'success',
        ]);
    }

}
