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
            if ($request->filled(["id", "qty"])) {
                $productId = $request->id;
                $qty = $request->qty;
                $color = $request->color ?  $request->color : null;
                $size = $request->size ? $request->size : null;
                $product = Product::find($productId);
                if ($product->category->libeleCateg == "Bijoux") {
                    Cart::instance('shopping')->add([
                        "id" => $product->id,
                        "name" => $product->title,
                        "price" => $product->promo ? $product->prix_promotion : $product->prix_actuel,
                        "weight" => 0,
                        "qty" => $qty,
                        "options" => ["photo" => $product->photo, "color" => $color, "size" => $size, "category" => $product->category->libeleCateg]
                    ]);
                    session()->put("last_visited", $productId);
                    session()->flash("success", "Produit ajouté au panier");
                } else if ($color && $size) {
                    $colors = array_column($product->imageProducts->toArray(), "color");
                    $key = array_search($color, $colors);
                    Cart::instance('shopping')->add([
                        "id" => $product->id,
                        "name" => $product->title,
                        "price" => $product->promo ? $product->prix_promotion : $product->prix_actuel,
                        "weight" => 0,
                        "qty" => $qty,
                        "options" => ["photo" => $product->imageProducts[$key]->image, "color" => $color, "size" => $size, "category" => $product->category->libeleCateg]
                    ]);
                    session()->put("last_visited", $productId);
                    session()->flash("success", "Produit ajouté au panier");
                } else {
                    session()->flash("error", "Informations manquantes");
                }
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
        $productSize = Product::find($item->id)->productSizes()
            ->where('size',  $item->options->size)->first();
        $stock = $productSize->colors[$item->options->color];
        if ($item->qty < $stock) {
            Cart::instance('shopping')->update($rowId, ["qty" => $item->qty + 1]);
        } else {
            session()->flash("error", "Quantite max");
        }
        return back();
    }

    public function degrade($rowId)
    {
        $item = Cart::instance('shopping')->get($rowId);
        Cart::instance('shopping')->update($rowId, ["qty" => $item->qty - 1]);
        return back();
    }
}
