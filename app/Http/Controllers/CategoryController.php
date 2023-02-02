<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getCategoryProducts($id) {
        $category = Categorie::find($id);
        return view("category", ['category' => $category]);
    }
}
