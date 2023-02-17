<?php

namespace App\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaimentController extends Controller
{
    public function paiment()
    {
        $payLink = Auth::user()->charge(Cart::priceTotal(), "Products");
        return view("paiment", ["payLink" => $payLink]);
    }
}
