<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CordonnerPayerController extends Controller
{
    public function cordonnerPayer()
    {
        if (Auth::check()) {
            return view("cordonnerPayer");
        } else {
            return redirect("/login");
        }
    }
}
