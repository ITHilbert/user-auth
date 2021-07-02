<?php

namespace ITHilbert\UserAuth\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use DateTime;
use DateTimeZone;
use Illuminate\Support\Facades\Mail;
use ITHilbert\LaravelKit\Helpers\MyDateTime;
use ITHilbert\UserAuth\App\Mail\ForgottenPassword;
use Illuminate\Support\Str;

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
     * Passwort Änderung speichern
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
                        ->with('message','Passwort wurde geändert');
    }



    /**
     * Öffnet das Formular um den Passwort ändern Token anzufordern
     *
     * @return void
     */
    public function forgotten(){
        return view('userauth::password.forgotten');
    }

    /**
     * Sendet die Mail mit dem Änderungstoken
     *
     * @param Request $request
     * @return void
     */
    public function sendtocken(Request $request){

        $request->validate([
            'email' => 'required',
        ]);

        $email = $request->email;

        $user = User::where('email', $email)->where('deleted_at', NULL)->first();

        $user->edit_pw_token = Str::random(10);

        $zeit = new MyDateTime('now');
        $zeit->addMin(30);
        $user->edit_pw_token_end = $zeit->getDateTimeISO();

        $user->update();

        if(isset($user)){
            Mail::to($email)->send(new ForgottenPassword($user));

            return redirect()->route('password.tokensend')
                        ->with('message','Bitte prüfen Sie Ihren Posteingang (ggf. auch den SPAM Ordner).');
        }else{
            redirect()->back()->withErrors('Kein Treffer');
        }
    }

    /**
     * Öffnet die View Token wurde gesendet
     *
     * @return void
     */
    public function tokensend(){
        return view('userauth::password.tokensend');
    }


    /**
     * Öffnet die View zum Passwort ändern mit Token
     *
     * @param [type] $token der Token zum ändern des Passwortes
     * @param [type] $email die E-Mail Adresse des Users
     * @return void
     */
    public function editwithtoken($token, $email){
        return view('userauth::password.editwithtoken')->with(compact('token', 'email'));
    }

    /**
     * Ändert das Passwort mit Token
     *
     * @param Request $request
     * @return void
     */
    public function updatewithtoken(Request $request)
    {
        $request->validate([
           'password' => 'required|min:8|confirmed',
           'password_confirmation' => 'required|same:password',
           'pwtoken' => 'required',
           'email' => 'email',
       ]);

       $user = User::where('email', $request->email)->where('edit_pw_token', $request->pwtoken)->where('deleted_at', NULL)->first();

       $date1 = new MyDateTime('now');
       $date2 = new MyDateTime($user->edit_pw_token_end);

       //echo $date1->getTimestamp() . ' - ' . $date2->getTimestamp();

       if($date1->getTimestamp() > $date2->getTimestamp()){
            return view('userauth::password.forgotten')->withErrors('Token ist abgelaufen.');
       }

       if( isset($user)){
            $user->password = Hash::make($request->password);
            $user->edit_pw_token = NULL;
            $user->edit_pw_token_end = null;
            $user->update();

            return redirect()->route('home')
                        ->with('message','Passwort wurde geändert');
       }else{
            view('userauth::password.forgotten')->withErrors('Änderung nicht möglich.');
       }
    }

}
