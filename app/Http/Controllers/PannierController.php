<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class PannierController extends Controller
{
    public function pannier(Request $request)
    {
        if ($request->isMethod("post")) {
            if ($request->filled(["id", "qty", "color", "size"])) {
                $productId = $request->id;
                $qty = $request->qty;
                $color = $request->color;
                $size = $request->size;
                $product = Product::find($productId);
                Cart::instance('shopping')->add([
                    "id" => $product->id,
                    "name" => $product->title,
                    "price" => $product->promo ? $product->prix_promotion : $product->prix_actuel,
                    "weight" => 0,
                    "qty" => $qty,
                    "options" => ["photo" => $product->photo, "color" => $color, "size" => $size]
                ]);
                session()->put("last_visited", $productId);
                session()->flash("success", "Produit ajouté au panier");
            } else {
                session()->flash("error", "Informations manquantes");
            }
            return back();
        }
        return view("pannier");
    }

    public function deleteFromCart($rowId)
    {
        Cart::instance('shopping')->remove($rowId);
        return back();
    }

    public function upgrade($rowId)
    {
        $item = Cart::instance('shopping')->get($rowId);
        Cart::instance('shopping')->update($rowId, ["qty" => $item->qty + 1]);
        return back();
    }

    public function degrade($rowId)
    {
        $item = Cart::instance('shopping')->get($rowId);
        Cart::instance('shopping')->update($rowId, ["qty" => $item->qty - 1]);
        return back();
    }
}
