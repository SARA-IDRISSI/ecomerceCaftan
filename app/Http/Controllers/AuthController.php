<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            $credentials = $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required'],
            ]);

            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();

                return redirect("/home");
            } else {
                session()->flash('error', "Email ou mot de passe incorrect");
                return back();
            }
        }
        return view('auth.login');
    }

    public function register(Request $request)
    {
        if ($request->isMethod('post')) {
            $myUser = User::where("email", "=", $request->email)->getQuery();
            if ($myUser->exists()) {
                session()->flash('error', "L'email existe déjà");
                // $_SESSION['error'] = "email existe déjà"
                return back();
            }
            // On crée un nouvel utilisateur
            $user = new User();
            // On remplit les données de l'utilisateur
            $user->username = $request->username;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->lastActivity = Carbon::now();
            $user->loggedIn = false;
            $user->newsletter = $request->newsletter ? true : false;
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $user->image = 'storage/' . $request->file('image')->store('users/images');
            }
            $user->save();
            return redirect('/login');
        }
        return view('auth.register');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
