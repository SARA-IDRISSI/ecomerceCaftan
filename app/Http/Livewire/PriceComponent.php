<?php

namespace App\Http\Livewire;

use Livewire\Component;

class PriceComponent extends Component
{
    public $checked;
    public $prix_actuel;
    public $prix_promotion;

    public function mount($promo = null, $prix_actuel = null, $prix_promotion = null)
    {
        $this->prix_actuel = $prix_actuel;
        $this->prix_promotion = $prix_promotion;
        $this->checked = $promo ? 1 : false;
    }
    public function render()
    {
        return view('livewire.price-component');
    }
}
