<?php

namespace ITHilbert\UserAuth\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Lang;
use Yajra\DataTables\Facades\DataTables;
use ITHilbert\LaravelKit\Helpers\HButton;
use ITHilbert\UserAuth\Entities\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request)
    {
        $data = Permission::latest()->where('deleted_at', NULL)->get();

        if ($request->ajax()) {
            return Datatables::of($data)
                    /* ->addIndexColumn() */
 /*                    ->addColumn('cname', function($row){
                            return $row->getName();
                    }) */
                    ->addColumn('action', function($row){
                        $ausgabe = '<div style="white-space: nowrap;">';
                        //$ausgabe .= HButton::show(route('permission.show', $row->id), '');
                        $ausgabe .= HButton::edit(route('permission.edit', $row->id), '');
                        $ausgabe .= HButton::delete($row->id, '');
                        $ausgabe .= '</div>';

                        return $ausgabe;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }


        return view('userauth::permission.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('userauth::permission.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'permission_display' => 'required | unique:permissions',
        ]);

        $perm_display = $request->permission_display;
        $perm_lcase = strtolower( str_replace(' ','', $perm_display));


        if(isset($request->permission_crud)){
            //CRUD Recht anlegen

            //create
            $permission = new Permission();
            $permission->permission_display = $perm_display .' ' . __('userauth::permission.create');
            $permission->permission = $perm_lcase .'_create';
            $permission->save();

            //lesen
            $permission = new Permission();
            $permission->permission_display = $perm_display .' ' . __('userauth::permission.read');
            $permission->permission = $perm_lcase .'_read';
            $permission->save();

            //ändern
            $permission = new Permission();
            $permission->permission_display = $perm_display .' ' . __('userauth::permission.edit');
            $permission->permission = $perm_lcase .'_edit';
            $permission->save();

            //lesen
            $permission = new Permission();
            $permission->permission_display = $perm_display .' ' . __('userauth::permission.delete');
            $permission->permission = $perm_lcase .'_delete';
            $permission->save();

        }else{
            //Nur dieses Recht anlegen
            $permission = new Permission();
            $permission->permission_display = $perm_display;
            $permission->permission = $perm_lcase;
            $permission->save();
        }

        if($permission){
            return redirect()->route('permission.index')->with([
                'message'    => Lang::get('userauth::permission.MsgAddSuccess'),
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
        $permission = Permission::findOrFail($id);
        return view('userauth::permission.edit')->with(compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'permission_display' => 'required | unique:permissions',
        ]);

        $perm = $request->permission_display;

        $permission = Permission::find($id);
        $permission->permission_display = $perm;

        $perm = strtolower( str_replace(' ','', $perm));
        $permission->permission = $perm;
        $erg = $permission->update();

        if($erg){
            return redirect()->route('permission.index')->with([
                'message'    => Lang::get('userauth::permission.MsgEditSuccess'),
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
        $permission = Permission::find($id);
        $permission->delete();

        return redirect()->route('permission.index')->with([
            'message'    => Lang::get('userauth::permission.MsgDeleteSuccess'),
            'alert-type' => 'success',
        ]);
    }

    public function noPermission(Request $request, $id){
        return view('userauth::nopermission');
    }
}
