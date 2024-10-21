<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    //Afficher le formulaire de connexion
    public function showLoginForm(){
        return view('auth.login');
    }

    // ...
    public function login(Request $request){
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        // dd($request);
 
        if (Auth::attempt($credentials, (bool) $request->session())) {
            $request->session()->regenerate();
 
            return redirect()->intended(RouteServiceProvider::HOME);
        }
 
        return back()->withErrors([
            'email' => 'Informations erronées',
        ])->onlyInput('email');
    }

    //...

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
