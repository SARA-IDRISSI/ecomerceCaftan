<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class DetailController extends Controller
{
    public function getProduct($id) {
        $article = Product::find($id);
        return view("detailProduct", ['article' => $article]);
    }
}
