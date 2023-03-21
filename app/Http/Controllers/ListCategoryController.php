<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;

class ListCategoryController extends Controller
{
    public function allListCategory()
    {
        $pagination = 10;
        $listGategory = Categorie::paginate($pagination);
        return view("admin.listCategory", ["listCategory" => $listGategory]);
    }
    public function delete($id)
    {
        $listGategory = Categorie::find($id);
        $listGategory->delete();
        // return back();
        session()->flash('success', 'Categorie supprimé avec succès');
        return redirect("/listCategory");
    }
}
