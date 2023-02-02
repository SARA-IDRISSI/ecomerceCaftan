<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CordonnerPayerController extends Controller
{
    public function cordonnerPayer(){
        return view("cordonnerPayer");
    }
}
