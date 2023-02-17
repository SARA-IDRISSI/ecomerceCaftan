<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function getWishlist()
    {
        return view("wishlist");
    }

    public function addToWishlist($id)
    {
        $product = Product::find($id);
        $items = Cart::instance('wishlist')->search(function ($cartItem) use ($id) {
            return $cartItem->id == $id;
        });
        if (count($items) > 0) {
            foreach ($items as $item) {
                Cart::instance('wishlist')->remove($item->rowId);
            }
            session()->flash("success", "Produit retiré de la wishlist");
        } else {
            Cart::instance("wishlist")->add([
                "id" => $product->id,
                "name" => $product->title,
                "price" => $product->promo ? $product->prix_promotion : $product->prix_actuel,
                "weight" => 0,
                "qty" => 1,
                "options" => ["photo" => $product->photo, "prix_actuel" => $product->prix_actuel, "prixPromo" => $product->prix_promotion]
            ]);
            session()->flash("success", "Produit ajouté à la wishlist");
        }
        return back();
    }


    public function deleteFromWishlist($rowId)
    {
        Cart::instance('wishlist')->remove($rowId);
        return back();
    }
}
