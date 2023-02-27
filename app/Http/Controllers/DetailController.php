<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;

class DetailController extends Controller
{
    public function getProduct($id)
    {
        $article = Product::find($id);
        $best_sellers = Product::orderBy("nbr_sales", "DESC")->limit(4)->get();

        return view("detailProduct", ['article' => $article, "best_sellers" => $best_sellers]);
    }


    public function buyNow(Request $request)
    {
        if ($request->isMethod("post")) {
            if (Auth::check()) {
                if ($request->filled(["id", "qty", "color", "size"])) {
                    $productId = $request->id;
                    $qty = $request->qty;
                    $color = $request->color;
                    $size = $request->size;
                    $product = Product::find($productId);
                    Cart::add([
                        "id" => $product->id,
                        "name" => $product->title,
                        "price" => $product->promo ? $product->prix_promotion : $product->prix_actuel,
                        "weight" => 0,
                        "qty" => $qty,
                        "options" => ["photo" => $product->photo, "color" => $color, "size" => $size]
                    ]);
                    session()->put("last_visited", $productId);
                    return redirect("/cordonnerPayer");
                } else {
                    session()->flash("error", "Veuillez choisir la couleur et la taille");
                    return back();
                }
            } else {
                return redirect("/login");
            }
        }
    }
}
