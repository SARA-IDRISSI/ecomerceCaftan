<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;


class AllProductComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $successMessage;
    public $search = '';
    public $title = '';
    public $promo = '';
    public $date = '';


    public function mount()
    {
        $this->successMessage = "";
    }

    public function delete($id)
    {
        $product = Product::find($id);
        $product->delete();
        $this->successMessage = "Article supprimé avec succès";
    }
    public function handleChange($value)
    {
        $this->title = $value;
    }
    public function handleChangePromo($value)
    {
        $this->promo = $value;
    }

    public function handleChangeDate($value)
    {
        $this->date = $value;
    }

    public function render()
    {
        $articles = Product::when($this->title !== "", function ($query) {
            $query->where("title", 'like', "%$this->title%");
        })->when($this->promo !== "", function ($query) {
            $query->where("promo", "=", $this->promo);
        })->when($this->date !== "", function ($query) {
            $query->whereDate('created_at', $this->date);
        })->orderBy("created_at", "DESC")->paginate(10);

        return view('livewire.all-product-component', ['articles' => $articles]);
    }
}
// ->orderBy("created_at", "DESC")
