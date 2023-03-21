<?php

namespace App\Http\Livewire;

use App\Models\Categorie;
use App\Models\Product;
use App\Models\ProductSize;
use App\Models\SubCategory;
use Livewire\Component;

class SubCategoryComponent extends Component
{

    public $products = [], $sizes, $sizeInputs = [], $colorsBtn = [];
    protected $queryString = ['sizeInputs', 'colorsBtn'];
    public SubCategory $subCategory;
    public $subCategoryId;
    public $message;
    public $productSizes;

    public $min_value = 0;
    public $max_value = 4000;
    public $left = 0;
    public $right = 0;
    public $orderBy = "Default Sorting";

    public function mount($id)
    {
        $this->subCategory = SubCategory::find($id);
        $this->products = $this->subCategory->products();
        $this->productSizes = ProductSize::all();
        $this->subCategoryId = $id;
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
        if ($this->orderBy == 'Price: Low to High') {
            $this->products = Product::where('sub_category_id', $this->subCategoryId)
                ->when($this->min_value > 0 || $this->max_value < 4000, function ($query) {
                    $query->where("promo", 1)
                        ->whereBetween('prix_promotion', [$this->min_value, $this->max_value])
                        ->orWhere("promo", 0)
                        ->whereBetween('prix_actuel', [$this->min_value, $this->max_value])
                        ->where('sub_category_id', $this->subCategoryId);
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
        } else if ($this->orderBy == 'Price: High to Low') {
            $this->products = Product::where('sub_category_id', $this->subCategoryId)
                ->when($this->min_value > 0 || $this->max_value < 4000, function ($query) {
                    $query->where("promo", 1)
                        ->whereBetween('prix_promotion', [$this->min_value, $this->max_value])
                        ->orWhere("promo", 0)
                        ->whereBetween('prix_actuel', [$this->min_value, $this->max_value])
                        ->where('sub_category_id', $this->subCategoryId);
                })
                ->when(count($this->sizeInputs) > 0, function ($query) {
                    $query->whereHas("productSizes", function ($q) {
                        $q->whereIn('size', $this->sizeInputs);
                    });
                })->when(count($this->colorsBtn) > 0, function ($query) {
                    $query->whereHas("productSizes", function ($q) {
                        $q->whereIn('colors', $this->colorsBtn);
                    });
                })->orderBy('prix_actuel', 'DESC')
                ->get();
        } else if ($this->orderBy == 'Sort By Newness') {
            $this->products = Product::where('sub_category_id', $this->subCategoryId)
                ->when($this->min_value > 0 || $this->max_value < 4000, function ($query) {
                    $query->where("promo", 1)
                        ->whereBetween('prix_promotion', [$this->min_value, $this->max_value])
                        ->orWhere("promo", 0)
                        ->whereBetween('prix_actuel', [$this->min_value, $this->max_value])
                        ->where('sub_category_id', $this->subCategoryId);
                })
                ->when(count($this->sizeInputs) > 0, function ($query) {
                    $query->whereHas("productSizes", function ($q) {
                        $q->whereIn('size', $this->sizeInputs);
                    });
                })->when(count($this->colorsBtn) > 0, function ($query) {
                    $query->whereHas("productSizes", function ($q) {
                        $q->whereIn('colors', $this->colorsBtn);
                    });
                })->orderBy('created_at', 'DESC')
                ->get();
        } else {
            $this->products = Product::where('sub_category_id', $this->subCategoryId)
                ->when($this->min_value > 0 || $this->max_value < 4000, function ($query) {
                    $query->where("promo", 1)
                        ->whereBetween('prix_promotion', [$this->min_value, $this->max_value])
                        ->orWhere("promo", 0)
                        ->whereBetween('prix_actuel', [$this->min_value, $this->max_value])
                        ->where('sub_category_id', $this->subCategoryId);
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
        }
        if (count($this->products) == 0) {
            $this->message = "No products available" . implode(",", $this->sizeInputs);
        } else {
            $this->message = "";
        }
        return view('livewire.sub-category-component')->layout("layouts.base");
    }
}
