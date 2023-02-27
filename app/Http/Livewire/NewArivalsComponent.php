<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\ProductSize;
use Livewire\Component;

class NewArivalsComponent extends Component
{
    public $products = [], $sizes, $sizeInputs = [], $colorsBtn = [];
    protected $queryString = ['sizeInputs', 'colorsBtn'];
    public $message;
    public $productSizes;

    public $min_value = 0;
    public $max_value = 1000;
    public $orderBy = "Default Sorting";

    public function mount()
    {
        $this->products = Product::orderBy('created_at', 'DESC')->limit(10)->get();
        $this->productSizes = ProductSize::all();
        $this->message = "";
    }
    public function changeOrderBy($order)
    {
        $this->orderBy = $order;
    }
    public function render()
    {
        if ($this->orderBy == 'Price: Low to High') {
            $this->products = Product::orderBy('created_at', 'DESC')->when($this->min_value != 0 || $this->max_value != 1000, function ($query) {
                $query->where("promo", 1)
                    ->whereBetween('prix_promotion', [$this->min_value, $this->max_value])
                    ->orWhere("promo", 0)
                    ->whereBetween('prix_actuel', [$this->min_value, $this->max_value]);
            })->when(count($this->sizeInputs) > 0, function ($query) {
                $query->whereHas("productSizes", function ($q) {
                    $q->whereIn('size', $this->sizeInputs);
                });
            })->when(count($this->colorsBtn) > 0, function ($query) {
                $query->whereHas("productSizes", function ($q) {
                    $q->whereIn('colors', $this->colorsBtn);
                });
            })->limit(10)->orderBy('prix_actuel', 'ASC')
                ->get();
        } else if ($this->orderBy == 'Price: High to Low') {
            $this->products = Product::orderBy('created_at', 'DESC')->when($this->min_value != 0 || $this->max_value != 1000, function ($query) {
                $query->where("promo", 1)
                    ->whereBetween('prix_promotion', [$this->min_value, $this->max_value])
                    ->orWhere("promo", 0)
                    ->whereBetween('prix_actuel', [$this->min_value, $this->max_value]);
            })->when(count($this->sizeInputs) > 0, function ($query) {
                $query->whereHas("productSizes", function ($q) {
                    $q->whereIn('size', $this->sizeInputs);
                });
            })->when(count($this->colorsBtn) > 0, function ($query) {
                $query->whereHas("productSizes", function ($q) {
                    $q->whereIn('colors', $this->colorsBtn);
                });
            })->limit(10)->orderBy('prix_actuel', 'DESC')
                ->get();
        } else if ($this->orderBy == 'Sort By Newness') {
            $this->products = Product::orderBy('created_at', 'DESC')->when($this->min_value != 0 || $this->max_value != 1000, function ($query) {
                $query->where("promo", 1)
                    ->whereBetween('prix_promotion', [$this->min_value, $this->max_value])
                    ->orWhere("promo", 0)
                    ->whereBetween('prix_actuel', [$this->min_value, $this->max_value]);
            })->when(count($this->sizeInputs) > 0, function ($query) {
                $query->whereHas("productSizes", function ($q) {
                    $q->whereIn('size', $this->sizeInputs);
                });
            })->when(count($this->colorsBtn) > 0, function ($query) {
                $query->whereHas("productSizes", function ($q) {
                    $q->whereIn('colors', $this->colorsBtn);
                });
            })->limit(10)->orderBy('created_at', 'DESC')
                ->get();
        } else {
            $this->products = Product::orderBy('created_at', 'DESC')->when($this->min_value != 0 || $this->max_value != 1000, function ($query) {
                $query->where("promo", 1)
                    ->whereBetween('prix_promotion', [$this->min_value, $this->max_value])
                    ->orWhere("promo", 0)
                    ->whereBetween('prix_actuel', [$this->min_value, $this->max_value]);
            })->when(count($this->sizeInputs) > 0, function ($query) {
                $query->whereHas("productSizes", function ($q) {
                    $q->whereIn('size', $this->sizeInputs);
                });
            })->when(count($this->colorsBtn) > 0, function ($query) {
                $query->whereHas("productSizes", function ($q) {
                    $q->whereIn('colors', $this->colorsBtn);
                });
            })->limit(10)->orderBy('prix_actuel', 'ASC')
                ->get();
        }
        if (count($this->products) == 0) {
            $this->message = "No products available " . implode(",", $this->sizeInputs);
        } else {
            $this->message = "";
        }
        return view('livewire.new-arivals-component')->layout("layouts.base");
    }
}
