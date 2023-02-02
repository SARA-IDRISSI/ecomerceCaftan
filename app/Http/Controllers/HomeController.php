<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        // Récupérer tous les produits;
        //$products = Product::all();
        $products = Product::orderBy("created_at", "DESC")->limit(10)->get();
        return view('home', ["products" => $products]);
    }
}
