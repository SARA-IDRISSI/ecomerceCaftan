<?php

namespace App\Http\Livewire;

use Livewire\Component;

class DetailProductComponents extends Component
{

    public  $product, $qtn, $prodClorsSelectedQuantity, $quantityCount = 1;

    public function incrementQuantity()
    {
        if ($this->quantityCount < 10) {
            $this->qtn = $this->quantityCount++;
        }
    }
    public function decrementQuantity()
    {
        if ($this->quantityCount > 1) {
            $this->quantityCount--;
        }
    }
    public function colorSelected($IdProductColor)
    {
        $productSize = $this->product->ProductSize()->where('id', $IdProductColor)->first();
        $this->prodClorsSelectedQuantity = $productSize->stock;

        if ($this->prodClorsSelectedQuantity == 0) {
            $this->prodClorsSelectedQuantity = 'outOfStock';
        }
    }
    public function mount()
    {
    }
    public function render()
    {
        return view('livewire.detail-product-components');
    }
}
