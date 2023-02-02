<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductSize;
use Illuminate\Http\Request;
use App\Models\Categorie;
use App\Models\SubCategory;

class AdminController extends Controller
{
    public function admin(){
        return view("admin.dashboard");
    }

    public function addProduct(Request $request){
        if($request->isMethod('post')) {
            if($request->filled(['title', 'description', 'codebar','prixenciene','prixactuel','category_id'])) {
                if($request->hasFile('image') && $request->file('image')->isValid()) {
                    $image = 'storage/' . $request->image->store('products/image');
                    $instock = 0;
                    if($request->size_count > 0) {
                        for($i = 1; $i <= $request->size_count; $i++) {
                            $instock += $request->input("stock-$i");
                        }
                    }
                    $product = Product::create([
                        'title' => $request->title,
                        'description' => $request->description,
                        'photo' => $image,
                        'barcode'=>$request->codebar,
                        'instock' => $instock,
                        'promo'=> $request->promo ? true : false,
                        'prix_actuel'=>$request->prixenciene,
                        'prix_promotion'=>$request->prixactuel,
                        'categorie_id'=> $request->category_id,
                        'sub_category_id'=> $request->sub_category_id ? $request->sub_category_id : null,
                    ]);
                    if($request->size_count > 0) {
                        for($i = 1; $i <= $request->size_count; $i++) {
                            $productSize = new ProductSize();
                            $productSize->product_id = $product->id;
                            $productSize->size = $request->input("size-$i");
                            $productSize->color = $request->input("color-$i");
                            $productSize->stock = $request->input("stock-$i");
                            $productSize->save();
                        }
                    }
                    session()->flash('success', "Produit ajouté avec succès");
                    return back();
                }
                else {
                    session()->flash('error', "L'image est obligatoire");
                    return back();
                }
            } else {
                session()->flash('error', "Les champs sont obligatoires");
                return back();
            }
        }
        return view("admin.dashboard");
    }
    public function addCategory(Request $request){
        if($request->isMethod('post')) {
            if($request->filled(['title'])){
                Categorie::create([
                    'libeleCateg'=>$request->title
                ]);
                // $category = new Categorie();
                // $category->title = $request->title;
                // $category->save();
                session()->flash('success', 'Catégorie ajoutée avec succès!');
                return back();
            } else {
                session()->flash('error', 'Champs obligatoire');
                return back();
            }
        }
        return view('admin.newCategory');
    }
    public function addSubCategory(Request $request){
        if($request->isMethod('post')) {
            if($request->filled(['title', 'category_id'])){
                SubCategory::create([
                    'title'=>$request->title,
                    'categorie_id' => $request->category_id
                ]);
                // $category = new Categorie();
                // $category->title = $request->title;
                // $category->save();
                session()->flash('success', 'Sous Catégorie ajoutée avec succès!');
                return back();
            } else {
                session()->flash('error', 'Champs obligatoire');
                return back();
            }
        }
        return view('admin.newSubCategory');
    }
}

