<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class NewArivalsController extends Controller
{
    public function NewArivals()
    {
        $newArivals = Product::orderBy('created_at', 'DESC')->limit(5)->get();
        return view("NewArivals", ["products" => $newArivals]);
    }
}
