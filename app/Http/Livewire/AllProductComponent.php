<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class AllProductComponent extends Component
{
    public $articles;

    public $successMessage;


    public function mount()
    {
        $this->articles = Product::orderBy("created_at", "DESC")->get();
        $this->successMessage = "";
    }

    public function delete($id)
    {
        $product = Product::find($id);
        $product->delete();
        $this->articles = Product::all();
        $this->successMessage = "Article supprimé avec succès";
    }
    public function render()
    {
        return view('livewire.all-product-component');
    }
}
