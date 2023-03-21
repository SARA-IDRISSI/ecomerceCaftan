<?php

namespace App\Http\Livewire;

use App\Models\Categorie;
use App\Models\Product;
use App\Models\ProductSize;
use Livewire\Component;
use Livewire\WithPagination;


class CategoryComponent extends Component

{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public  $sizes, $sizeInputs = [], $colorsBtn = [];
    protected $queryString = ['sizeInputs', 'colorsBtn'];
    public Categorie $category;
    public $categoryId;
    public $message;
    public $productSizes;

    public $min_value = 0;
    public $max_value = 4000;
    public $left = 0;
    public $right = 0;
    public $orderBy = "Default Sorting";

    public function mount($id)
    {
        $this->category = Categorie::find($id);
        $this->productSizes = ProductSize::all();
        $this->categoryId = $id;
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
        $products = $this->category->products();
        if ($this->orderBy == 'Price: Low to High') {
            $products = Product::where('categorie_id', $this->categoryId)
                ->when($this->min_value > 0 || $this->max_value < 4000, function ($query) {
                    $query->where("promo", 1)
                        ->whereBetween('prix_promotion', [$this->min_value, $this->max_value])
                        ->orWhere("promo", 0)
                        ->whereBetween('prix_actuel', [$this->min_value, $this->max_value])
                        ->where('categorie_id', $this->categoryId);
                })
                ->when(count($this->sizeInputs) > 0, function ($query) {
                    $query->whereHas("productSizes", function ($q) {
                        $q->whereIn('size', $this->sizeInputs);
                    });
                })->when(count($this->colorsBtn) > 0, function ($query) {
                    $query->whereHas("productSizes", function ($q) {
                        $firstColor = $this->colorsBtn[0];
                        $q->where('colors', 'LIKE', "%$firstColor%");
                        if (count($this->colorsBtn) > 1) {
                            for ($i = 1; $i < count($this->colorsBtn); $i++) {
                                $color = $this->colorsBtn[$i];
                                $q->orWhere('colors', 'LIKE', "%$color%");
                            }
                        }
                    });
                })->orderBy('prix_actuel', 'ASC')
                ->paginate(12);
        } else if ($this->orderBy == 'Price: High to Low') {
            $products = Product::where('categorie_id', $this->categoryId)
                ->when($this->min_value > 0 || $this->max_value < 4000, function ($query) {
                    $query->where("promo", 1)
                        ->whereBetween('prix_promotion', [$this->min_value, $this->max_value])
                        ->orWhere("promo", 0)
                        ->whereBetween('prix_actuel', [$this->min_value, $this->max_value])
                        ->where('categorie_id', $this->categoryId);
                })
                ->when(count($this->sizeInputs) > 0, function ($query) {
                    $query->whereHas("productSizes", function ($q) {
                        $q->whereIn('size', $this->sizeInputs);
                    });
                })->when(count($this->colorsBtn) > 0, function ($query) {
                    $query->whereHas("productSizes", function ($q) {
                        $firstColor = $this->colorsBtn[0];
                        $q->where('colors', 'LIKE', "%$firstColor%");
                        if (count($this->colorsBtn) > 1) {
                            for ($i = 1; $i < count($this->colorsBtn); $i++) {
                                $color = $this->colorsBtn[$i];
                                $q->orWhere('colors', 'LIKE', "%$color%");
                            }
                        }
                    });
                })->orderBy('prix_actuel', 'DESC')
                ->paginate(12);
        } else if ($this->orderBy == 'Sort By Newness') {
            $products = Product::where('categorie_id', $this->categoryId)
                ->when($this->min_value > 0 || $this->max_value < 4000, function ($query) {
                    $query->where("promo", 1)
                        ->whereBetween('prix_promotion', [$this->min_value, $this->max_value])
                        ->orWhere("promo", 0)
                        ->whereBetween('prix_actuel', [$this->min_value, $this->max_value])
                        ->where('categorie_id', $this->categoryId);
                })
                ->when(count($this->sizeInputs) > 0, function ($query) {
                    $query->whereHas("productSizes", function ($q) {
                        $q->whereIn('size', $this->sizeInputs);
                    });
                })->when(count($this->colorsBtn) > 0, function ($query) {
                    $query->whereHas("productSizes", function ($q) {
                        $firstColor = $this->colorsBtn[0];
                        $q->where('colors', 'LIKE', "%$firstColor%");
                        if (count($this->colorsBtn) > 1) {
                            for ($i = 1; $i < count($this->colorsBtn); $i++) {
                                $color = $this->colorsBtn[$i];
                                $q->orWhere('colors', 'LIKE', "%$color%");
                            }
                        }
                    });
                })->orderBy('created_at', 'DESC')
                ->paginate(12);
        } else {
            $products = Product::where('categorie_id', $this->categoryId)
                ->when($this->min_value > 0 || $this->max_value < 4000, function ($query) {
                    $query->where("promo", 1)
                        ->whereBetween('prix_promotion', [$this->min_value, $this->max_value])
                        ->orWhere("promo", 0)
                        ->whereBetween('prix_actuel', [$this->min_value, $this->max_value])
                        ->where('categorie_id', $this->categoryId);
                })
                ->when(count($this->sizeInputs) > 0, function ($query) {
                    $query->whereHas("productSizes", function ($q) {
                        $q->whereIn('size', $this->sizeInputs);
                    });
                })->when(count($this->colorsBtn) > 0, function ($query) {
                    $query->whereHas("productSizes", function ($q) {
                        $firstColor = $this->colorsBtn[0];
                        $q->where('colors', 'LIKE', "%$firstColor%");
                        if (count($this->colorsBtn) > 1) {
                            for ($i = 1; $i < count($this->colorsBtn); $i++) {
                                $color = $this->colorsBtn[$i];
                                $q->orWhere('colors', 'LIKE', "%$color%");
                            }
                        }
                    });
                })->orderBy('prix_actuel', 'ASC')
                ->paginate(12);
        }
        if (count($products) == 0) {
            $this->message = "No products available" . implode(",", $this->sizeInputs);
        } else {
            $this->message = "";
        }
        return view('livewire.category-component', ["products" => $products])->layout("layouts.base");
    }
}
