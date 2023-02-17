<?php

namespace App\Http\Controllers;

use App\Mail\ForgotPasswordMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class forgotPasswordController extends Controller
{
    public function forgot()
    {
        return view("auth.forgotPassword");
    }
    public function sendEmail(Request $request)
    {
        if ($request->isMethod("post")) {
            $user = User::where("email", $request->email)->getQuery();
            if ($user->exists()) {
                $user = $user->first();
                Mail::to($request->email)->send(new ForgotPasswordMail($user->email, $user->username));
                session()->flash("success", "Email envoyé avec succès veuillez consultez votre inbox!");
                return back();
            } else {
                session()->flash("error", "Email invalid");
                return back();
            }
        }
    }
}
