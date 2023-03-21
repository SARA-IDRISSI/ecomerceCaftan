<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class changePasswordController extends Controller
{
    public function changePassword(Request $request)
    {
        if ($request->isMethod("post")) {
            if ($request->password == $request->confirm) {
                $user = User::where("email", $request->email)->getQuery();
                if ($user->exists()) {
                    User::where("email", $request->email)->update([
                        "password" => Hash::make($request->password)
                    ]);
                    session()->flash("success", "Mot de passe mis à jour!");
                    return back();
                } else {
                    session()->flash("error", "Email invalid");
                    return back();
                }
            } else {
                session()->flash("error", "les mots ne sont pas identiques");
                return back();
            }
        }
        return view("auth.changePassword");
    }
}


