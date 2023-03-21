<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;

class DetailController extends Controller
{
    public $category, $product, $prodClorsSelectedQuantity;

    public function getProduct($id)
    {
        $article = Product::find($id);
        $best_sellers = Product::where("nbr_sales", ">", 0)->orderBy("nbr_sales", "DESC")->limit(4)->get();

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
                    if ($product->category->libeleCateg == "Bijoux") {
                        Cart::instance('shopping')->add([
                            "id" => $product->id,
                            "name" => $product->title,
                            "price" => $product->promo ? $product->prix_promotion : $product->prix_actuel,
                            "weight" => 0,
                            "qty" => $qty,
                            "options" => ["photo" => $product->photo, "color" => $color, "size" => $size]
                        ]);
                    } else if ($color && $size) {
                        $colors = array_column($product->imageProducts->toArray(), "color");
                        $key = array_search($color, $colors);
                        Cart::instance('shopping')->add([
                            "id" => $product->id,
                            "name" => $product->title,
                            "price" => $product->promo ? $product->prix_promotion : $product->prix_actuel,
                            "weight" => 0,
                            "qty" => $qty,
                            "options" => ["photo" => $product->imageProducts[$key]->image, "color" => $color, "size" => $size]
                        ]);
                    }
                } else {
                    session()->flash("error", "Veuillez choisir la couleur et la taille");
                    return back();
                }
                session()->put("last_visited", $productId);
                return redirect("/cordonnerPayer");
            } else {
                return redirect("/login");
            }
        }
    }
}
