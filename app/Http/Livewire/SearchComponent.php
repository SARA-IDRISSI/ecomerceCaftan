<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\ProductSize;
use Livewire\Component;

class SearchComponent extends Component
{
    public $products, $sizes, $sizeInputs = [], $colorsBtn = [];
    protected $queryString = ['sizeInputs', 'colorsBtn'];


    public $message;
    public $productSizes;

    public $min_value = 0;
    public $max_value = 4000;
    public $left = 0;
    public $right = 0;
    public $orderBy = "Default Sorting";
    public $q;
    public $search_term;

    public function mount()
    {
        $this->fill(request()->only('q'));
        $this->search_term = "%" . $this->q . "%";
        $this->productSizes = ProductSize::all();
        $this->message = "";
    }

    public function changeOrderBy($order)
    {
        $this->orderBy = $order;
    }


    public function handleRange($value, $type)
    {

        if ($this->max_value - $this->min_value >= 200 && $this->max_value <= 200) {
            if ($type === "input-min") {
                $this->left = ($this->min_value / 4000) * 100 + "%";
            } else {
                $this->right = 100 - ($this->max_value / 4000) * 100 + "%";
            }
        }
    }
    public function render()
    {
        $this->products = Product::where("title", "like", $this->search_term)->when($this->min_value != 0 || $this->max_value != 4000, function ($query) {
            $query->where("promo", 1)
                ->whereBetween('prix_promotion', [$this->min_value, $this->max_value])
                ->orWhere("promo", 0)
                ->whereBetween('prix_actuel', [$this->min_value, $this->max_value]);
        })
            ->when(count($this->sizeInputs) > 0, function ($query) {
                $query->whereHas("productSizes", function ($q) {
                    $q->whereIn('size', $this->sizeInputs);
                });
            })->when(count($this->colorsBtn) > 0, function ($query) {
                $query->whereHas("productSizes", function ($q) {
                    $q->whereIn('colors', $this->colorsBtn);
                });
            })->orderBy('prix_actuel', 'ASC')
            ->get();
        if (count($this->products) == 0) {
            $this->message = "No products available for " . $this->q;
        } else {
            $this->message = "";
        }

        return view('livewire.search-component')->layout('layouts.base');
    }
}
