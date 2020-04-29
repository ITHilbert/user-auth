<?php

namespace ITHilbert\UserAuth\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\User;


class PasswordController extends Controller
{

    /**
     * Edit the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('userauth::password.edit');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $requestliste
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
           'password' => 'required|min:8|confirmed',
           'password_confirmation' => 'required|same:password'
       ]);

       $user = Auth()->user();
       $user->password = Hash::make($request->password);
       $user->update();

       return redirect()->route('home')
                        ->with('success','Passwort wurde geändert');
    }

}
