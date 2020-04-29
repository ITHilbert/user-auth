<?php

namespace ITHilbert\UserAuth\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Illuminate\Support\Facades\Lang;
use Yajra\DataTables\Facades\DataTables;

use ITHilbert\LaravelKit\Helpers\HButton;
use ITHilbert\UserAuth\Entities\Permission;
use ITHilbert\UserAuth\Entities\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request)
    {
        $data = Role::latest()->get();

        if ($request->ajax()) {
            return Datatables::of($data)
                    /* ->addIndexColumn() */
 /*                    ->addColumn('cname', function($row){
                            return $row->getName();
                    }) */
                    ->addColumn('action', function($row){
                        $ausgabe = '<div style="white-space: nowrap;">';
                        //$ausgabe .= HButton::show(route('permission.show', $row->id), '');
                        $ausgabe .= HButton::edit(route('role.edit', $row->id), '');
                        $ausgabe .= HButton::delete($row->id, '');
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
    public function create()
    {
        $permissions = Permission::all();

        return view('userauth::role.create')->with(compact('permissions'));
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
        foreach($request->permission as $permID){
            $perm = Permission::find($permID);
            $role->permissions()->save($perm);
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
        $permissions = Permission::all();

        return view('userauth::role.edit')->with(compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $role = Role::find($id);

        if($role->role_display != $request->role_display || $request->role_display == ''){
            $request->validate([
                'role_display' => 'required | unique:roles',
            ]);
        }

        $role->role_display = $request->role_display;
        $role->role = strtolower( str_replace(' ','', $request->role_display));
        $erg = $role->update();

        //Rechte speichern
        $role->permissions()->detach();
        foreach($request->permission as $permID){
            $perm = Permission::find($permID);
            $role->permissions()->save($perm);
        }

        if($erg){
            return redirect()->route('role.index')->with([
                'message'    => Lang::get('userauth::role.MsgEditSuccess'),
                'alert-type' => 'success',
            ]);
        }else{
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function delete($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
        return redirect()->route('role.index')->with([
            'message'    => Lang::get('userauth::role.MsgDeleteSuccess'),
            'alert-type' => 'success',
        ]);
    }

}
