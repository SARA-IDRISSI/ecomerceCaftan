<?php

namespace App\Http\Livewire;

use App\Models\Categorie;
use Livewire\Component;

class EditCategoryComponent extends Component
{
    public $idCat;
    public $name;
    public $message;
    public $errorMessage;
    public function mount($id)
    {
        $category = Categorie::find($id);
        $this->idCat = $category->id;
        $this->name = $category->libeleCateg;
    }
    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'name' => 'required'
        ]);
    }
    public function updateCategory()
    {
        if ($this->validate([
            'name' => 'required'
        ])) {

            $category = Categorie::find($this->idCat);
            $category->libeleCateg = $this->name;
            $category->save();
            $this->message = "Catégorie mis à jour avec succès!";
            $this->errorMessage = "";
        } else {
            $this->message = "";
            $this->errorMessage = "Catégorie non mis à jour avec succès!";
        }
    }
    public function render()
    {
        return view('livewire.edit-category-component')->layout('layouts.dashboard');
    }
}
