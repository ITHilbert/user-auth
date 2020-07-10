<?php

namespace ITHilbert\UserAuth\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Lang;
use Yajra\DataTables\Facades\DataTables;

use App\User;
use ITHilbert\LaravelKit\Entities\Log;
use ITHilbert\LaravelKit\Helpers\HButton;
use ITHilbert\UserAuth\Entities\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request)
    {
        $data = User::latest()->where('deleted_at', NULL)->get();

        if ($request->ajax()) {
            return Datatables::of($data)
                ->addColumn('RoleName', function ($row) {
                    return $row->roleDisplayname();
                })
                ->addColumn('action', function ($row) {
                    $ausgabe = '<div style="white-space: nowrap;">';
                    //$ausgabe .= HButton::show(route('permission.show', $row->id), '');
                    $ausgabe .= HButton::edit(route('user.edit', $row->id), '');
                    $ausgabe .= HButton::delete($row->id, '');
                    $ausgabe .= '</div>';

                    return $ausgabe;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('userauth::user.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $roles = Role::getComboBoxData();

        return view('userauth::user.create')->with(compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required',
            'email' => 'required | email | unique:users',
            'password'  => 'required',
            'password2'  => 'required | same:password',
            'role_id' => 'required',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role_id = $request->role_id;
        $user->password = Hash::make($request->password);

        $user->save();

        if ($user) {
            return redirect()->route('user.index')->with([
                'message'    => Lang::get('userauth::user.MsgAddSuccess'),
                'alert-type' => 'success',
            ]);
        } else {
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
        $user = User::findOrFail($id);
        $roles = Role::all();

        return view('userauth::user.edit')->with(compact('roles', 'user'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $editPW = false;

        //Wenn ein neues Passwort gesetzt wurde
        if ($request->password) {
            $request->validate([
                'name'  => 'required',
                'email' => 'required | email',
                'password'  => 'required',
                'password2'  => 'required | same:password',
                'role_id' => 'required',
            ]);
            $editPW = true;
        }else{
        //Ohne Änderung des Passwortes
            $request->validate([
                'name'  => 'required',
                'email' => 'required | email',
                'role_id' => 'required',
            ]);
        }

        //Benutzer laden
        $user = User::find($id);

        //Prüfen ob sich die E-Mail Adresse geändert hat
        if($user->email != $request->email){
            $request->validate([
                'name'  => 'required',
                'email' => 'required | email | unique:users',
                'role_id' => 'required',
            ]);
        }

        //Neue Daten speichern
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role_id = $request->role_id;

        //Falls das Passwort geändert werden soll
        if ($editPW) {
            $user->password = Hash::make($request->password);
        }

        $erg = $user->update();

        if ($erg) {
            return redirect()->route('user.index')->with([
                'message'    => Lang::get('userauth::user.MsgEditSuccess'),
                'alert-type' => 'success',
            ]);
        } else {
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
        $user = User::find($id);
        $user->delete();
        return redirect()->route('user.index')->with([
            'message'    => Lang::get('userauth::user.MsgDeleteSuccess'),
            'alert-type' => 'success',
        ]);
    }
}
