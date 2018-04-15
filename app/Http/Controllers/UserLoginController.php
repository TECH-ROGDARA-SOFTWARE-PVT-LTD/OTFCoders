<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserLoginController extends Controller
{
    public function login(Request $request){
        $remember = $request->get('remember');

        if(Auth::attempt([
            'email' => $request -> email,
            'password' => $request -> password
        ], $remember)){
            $user = USER::where('id',Auth::user()->id)->first();
            if($user->confirmed == 0) {
                Auth::logout();
                Session::flush();
                return redirect() -> back()->with('message', 'Please activate your account');
            }
        }
        return redirect() -> back()->with('message', 'Invalid E-mail or Password..!!');
    }

    public function logout(){
        Auth::logout();
        Session::flush();
        return redirect::route("/admin/login");
    }
}