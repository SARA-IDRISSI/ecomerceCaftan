<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PannierController extends Controller
{
    public function pannier(){
        return view("pannier");
    }
}
