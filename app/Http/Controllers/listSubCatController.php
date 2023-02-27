<?php

namespace App\Http\Controllers;

use App\Models\SubCategory;
use Illuminate\Http\Request;

class ListSubCatController extends Controller
{
    public function allListSubCategory()
    {
        $listSubCategory = SubCategory::all();
        return view("admin.listSubCategory", ["listSubCategory" => $listSubCategory]);
    }
    public function delete($id)
    {
        $listSubGategory = SubCategory::find($id);
        $listSubGategory->delete();
        // return back();
        session()->flash('success', 'SubCategorie supprimé avec succès');
        return redirect("/listSubCategory");
    }
}
