<?php

namespace ITHilbert\UserAuth\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Yajra\DataTables\Facades\DataTables;
use ITHilbert\LaravelKit\Helpers\HButton;
use ITHilbert\UserAuth\Entities\Permission;
use ITHilbert\UserAuth\Entities\PermissionGroup;
use ITHilbert\UserAuth\Traits\Format;
use function ITHilbert\UserAuth\Helpers\formatDisplayToIntern;

class PermissionController extends Controller
{
    use Format;

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request)
    {

        $data = PermissionGroup::latest()->where('deleted_at', NULL)->get();

        if ($request->ajax()) {
            $user = Auth::user(); // find(Auth::id());
            return Datatables::of($data)
                    /* ->addIndexColumn() */
 /*                    ->addColumn('cname', function($row){
                            return $row->getName();
                    }) */
                    ->addColumn('action', function($row) use ($user){
                        $ausgabe = '<div style="white-space: nowrap;">';
                        if($row->id > 3){
                            //$ausgabe .= HButton::show(route('permission.show', $row->id), '');
                            if($user->hasPermission('permission_edit')){
                                $ausgabe .= HButton::edit(route('permission.edit', $row->id), '');
                            }
                            if($user->hasPermission('permission_delete')){
                                $ausgabe .= HButton::delete($row->id, '');
                            }
                        }
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
            'group_display' => 'required | unique:permissions_groups',
            'group_name' => 'required | unique:permissions_groups',
        ]);

        $group_display = $request->group_display;
        $group_name = $this->formatDisplayToIntern($request->group_name);


        //Permissions group anlegen
        $group = new PermissionGroup();
        $group->group_name = $group_name;
        $group->group_display = $group_display;
        $group->save();

        //CRUD Recht anlegen

        //create
        $permission_create = new Permission();
        $permission_create->permission_display = $group_display .' ' . __('userauth::permission.create');
        $permission_create->permission = $group_name .'_create';
        $permission_create->group_id = $group->id;
        $permission_create->crud = 'create';
        $permission_create->save();

        //lesen
        $permission_read = new Permission();
        $permission_read->permission_display = $group_display .' ' . __('userauth::permission.read');
        $permission_read->permission = $group_name .'_read';
        $permission_read->group_id = $group->id;
        $permission_read->crud = 'read';
        $permission_read->save();

        //ändern
        $permission_edit = new Permission();
        $permission_edit->permission_display = $group_display .' ' . __('userauth::permission.edit');
        $permission_edit->permission = $group_name .'_edit';
        $permission_edit->group_id = $group->id;
        $permission_edit->crud = 'edit';
        $permission_edit->save();

        //delete
        $permission_delete = new Permission();
        $permission_delete->permission_display = $group_display .' ' . __('userauth::permission.delete');
        $permission_delete->permission = $group_name .'_delete';
        $permission_delete->group_id = $group->id;
        $permission_delete->crud = 'delete';
        $permission_delete->save();

        return redirect()->route('permission.index')->with([
            'message'    => Lang::get('userauth::permission.MsgAddSuccess'),
            'alert-type' => 'success',
        ]);

    }


    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $permissiongroup = PermissionGroup::findOrFail($id);
        return view('userauth::permission.edit')->with(compact('permissiongroup'));
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
            'group_display' => 'required' ,
            'group_name' => 'required',
        ]);

        $group_display = $request->group_display;
        $group_name = $this->formatDisplayToIntern($request->group_name);


        $group = PermissionGroup::find($id);
        $group->group_display = $request->group_display;
        $group->group_name = $request->group_name;
        $group->update();


        $permissions = Permission::where('group_id', $id)->get();
        foreach($permissions as $perm){
            if($perm->crud == 'create'){
                $perm->permission_display = $group_display .' ' . __('userauth::permission.create');
                $perm->permission = $group_name .'_create';
            }elseif($perm->crud == 'read'){
                $perm->permission_display = $group_display .' ' . __('userauth::permission.read');
                $perm->permission = $group_name .'_read';
            }elseif($perm->crud == 'edit'){
                $perm->permission_display = $group_display .' ' . __('userauth::permission.edit');
                $perm->permission = $group_name .'_edit';
            }else{
                $perm->permission_display = $group_display .' ' . __('userauth::permission.delete');
                $perm->permission = $group_name .'_delete';
            }
            $perm->update();

        }

        return redirect()->route('permission.index')->with([
            'message'    => Lang::get('userauth::permission.MsgEditSuccess'),
            'alert-type' => 'success',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function delete($id)
    {
        //Recht löschen
        $permissions = Permission::where('group_id', $id)->get();
        foreach ($permissions as $perm) {
            $perm->delete();
        }

        //Rechte Groupe löschen
        $group = PermissionGroup::find($id);
        $group->delete();

        return redirect()->route('permission.index')->with([
            'message'    => Lang::get('userauth::permission.MsgDeleteSuccess'),
            'alert-type' => 'success',
        ]);
    }

    public function noPermission(Request $request, $id){
        return view('userauth::nopermission');
    }
}
