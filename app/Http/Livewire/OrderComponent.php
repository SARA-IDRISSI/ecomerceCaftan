<?php

namespace App\Http\Livewire;

use App\Models\Order;
use Livewire\Component;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Livewire\WithPagination;


class OrderComponent extends Component
{
    use WithPagination;
    public $date = "";
    public $tel = "";
    public $name = "";


    public function handleChange($value)
    {
        $this->name = $value;
        // if ($value == "") {
        //     $this->orders = Order::all();
        // } else {
        //     $this->orders = Order::whereRelation("user", "firstname", "like", "%$value%")->orwhereRelation("user", "lastname", "like", "%$value%")->get();
        // }
    }

    public function handleChangeTele($value)
    {
        $this->tel = $value;
        // if ($value == "") {
        //     $this->orders = Order::paginate(1);
        // } else {
        //     $this->orders = Order::whereRelation("user", "contactNo", "like", "%$value%")->paginate(1)->get();
        // }
    }

    public function handleChangeDate($datee)
    {
        $this->date = $datee;
        // if ($datee == "") {
        //     $this->orders = Order::paginate(1);
        // } else {
        //     $this->orders = Order::whereDate('created_at', $datee)->paginate(1)->get();
        // }
    }
    public function render()
    {
        $orders = Order::when($this->name !== "", function ($query) {
            $query->whereRelation("user", "firstname", "like", "%$this->name%")->orwhereRelation("user", "lastname", "like", "%$this->name%");
        })->when($this->tel !== "", function ($query) {
            $query->whereRelation("user", "contactNo", "like", "%$this->tel%");
        })->when($this->date !== "", function ($query) {
            $query->whereDate('created_at', $this->date);
        })
            ->orderBy("created_at", "DESC")->paginate(10);
        return view('livewire.order-component', ['orders' => $orders]);
    }
}
