<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductSize;
use App\Models\User;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
{
    public function saveOrderUserDetails(Request $request)
    {
        if ($request->isMethod("post")) {
            User::where("id", Auth::user()->id)->update([
                "email" => $request->email,
                "firstname" => $request->firstname,
                "lastname" =>  $request->lastname,
                "pays" => $request->country,
                "contactNo" => $request->contactNo,
                "codePostal" => $request->codePostal,
                "ville" => $request->ville,
                "adressLine" => $request->adressLine,

            ]);
            return redirect("/paiment");
        } else {
            return back();
        }
    }

    public function makeOrder()
    {
        $order = Order::create([
            "user_id" => Auth::user()->id,
            "total" => Cart::instance('shopping')->priceTotal(),
        ]);
        foreach (Cart::instance('shopping')->content() as $item) {
            OrderItem::create([
                "order_id" => $order->id,
                "title" => $item->name,
                "prix_unitaire" => $item->price,
                "prix_total" => $item->price * $item->qty,
                "qty" => $item->qty,
                "picture" => $item->options->photo,
                "color" => $item->options->color,
                "size" => $item->options->size,
                "category" => $item->options->category
            ]);
            $product = Product::find($item->id);
            if ($item->options->category != "Bijoux") {
                $colors = [];
                $productSize = Product::find($item->id)->productSizes()
                    ->where('size',  $item->options->size)->first();
                foreach ($productSize->colors as $color => $stock) {
                    if ($item->options->color == $color) {
                        $newStock = $stock - $item->qty;
                        array_push($colors, "$color:$newStock");
                    } else {
                        array_push($colors, "$color:$stock");
                    }
                }
                ProductSize::where("id", $productSize->id)->update([
                    "colors" => implode(",", $colors),
                    "stock" =>  $productSize->stock > 0 ? $productSize->stock - $item->qty : 0
                ]);
            }
            Product::where("id", $item->id)->update([
                "nbr_sales" => $product->nbr_sales + 1,
                "instock" => $product->instock > 0 ? $product->instock - $item->qty : 0
            ]);
        }
        Cart::instance('shopping')->destroy();
        session()->flash("success", "Commande passée avec succès");
        return back();
    }
}
