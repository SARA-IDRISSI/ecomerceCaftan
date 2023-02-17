<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
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
            "total" => Cart::priceTotal(),
        ]);
        foreach (Cart::content() as $item) {
            OrderItem::create([
                "order_id" => $order->id,
                "title" => $item->name,
                "prix_unitaire" => $item->price,
                "prix_total" => $item->price * $item->qty,
                "qty" => $item->qty,
                "picture" => $item->options->photo,
                "color" => $item->options->color,
                "size" => $item->options->size
            ]);
            $product = Product::find($item->id);
            Product::where("id", $item->id)->update([
                "nbr_sales" => $product->nbr_sales + 1
            ]);
        }
        session()->flash("success", "Commande passée avec succès");
        return back();
    }
}
