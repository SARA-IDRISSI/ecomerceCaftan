<?php

namespace App\Http\Livewire;

use App\Models\Order;
use Livewire\Component;

class OrderComponent extends Component
{
    public $orders;

    public function mount()
    {
        $this->orders = Order::all();
    }

    public function handleChange($value)
    {
        if ($value == "") {
            $this->orders = Order::all();
        } else {
            $this->orders = Order::whereRelation("user", "firstname", "like", "%$value%")->orwhereRelation("user", "lastname", "like", "%$value%")->get();
        }
    }

    public function handleChangeTele($value)
    {
        if ($value == "") {
            $this->orders = Order::all();
        } else {
            $this->orders = Order::whereRelation("user", "contactNo", "like", "%$value%")->get();
        }
    }

    public function handleChangeDate($datee)
    {
        if ($datee == "") {
            $this->orders = Order::all();
        } else {
            $this->orders = Order::whereDate('created_at', $datee)->get();
        }
    }
    public function render()
    {
        return view('livewire.order-component');
    }
}
