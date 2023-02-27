<?php

namespace App\Http\Livewire;

use App\Models\SubCategory;
use Livewire\Component;

class EditSuBCategoryComponents extends Component
{


    public $idSubCat;
    public $name;
    public $category_id;
    public $message;
    public $errorMessage;
    public function mount($id)
    {
        $subcategory = SubCategory::find($id);
        $this->idSubCat = $subcategory->id;
        $this->name = $subcategory->title;
        $this->category_id = $subcategory->categorie_id;
    }
    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'name' => 'required'
        ]);
    }
    public function updateSubCategory()
    {
        if ($this->validate([
            'name' => 'required'
        ])) {

            $subcategory = SubCategory::find($this->idSubCat);
            $subcategory->title = $this->name;
            $subcategory->categorie_id = $this->category_id;
            $subcategory->save();
            $this->message = "SubCatégorie mis à jour avec succès!";
            $this->errorMessage = "";
        } else {
            $this->message = "";
            $this->errorMessage = "SubCatégorie non mis à jour avec succès!";
        }
    }
    public function render()
    {
        return view('livewire.edit-subcategory-component')->layout('layouts.dashboard');
    }
}
