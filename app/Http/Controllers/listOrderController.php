<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class listOrderController extends Controller
{
    public function listOrder()
    {
        return view("admin.listOrder");
    }

    public function show($id)
    {
        $order = Order::find($id);
        return view("admin.details-order", ["order" => $order]);
    }
}
