<?php

namespace App\Http\Controllers;

use App\Models\Product;

use Illuminate\Http\Request;

class AllProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view("admin.allProduct", ["articles" => $products]);
    }

    public function delete($id)
    {
        $product = Product::find($id);
        $product->delete();
        // return back();
        session()->flash('success', 'Produit supprimé avec succès');
        return redirect("/allProduct");
    }
}
