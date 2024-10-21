<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller 
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    //Afficher le formulaire d'inscription
    public function showRegistrationForm(){
        return view('auth.register');
    }

    // Enregistrer dans la BDD
    public function register(Request $request){
        $validated = $request->validate([
            'name' => ['required', 'string', 'between:5,255'],
            'email' => ['required', 'string', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);

        Auth::login($user);

        return redirect()->route('home')->withStatus('Inscription réussie !');

    }
}
