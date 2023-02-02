<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\ProductSize;
use Illuminate\Http\Request;

class EditController extends Controller
{
    public function edit(Request $request, $id){
        $article=Product::find($id);
        $sizes = ["S", "M", "L", "XL"];
        if($request->isMethod('post')) {
            $image = $article->photo;
            if($request->hasFile('image') && $request->file('image')->isValid()) {
                $image = 'storage/' . $request->image->store('products/image');
            }
            Product::where("id", $id)->update([
                'title' => $request->title,
                'description' => $request->description,
                'photo' => $image,
                'barcode'=>$request->codebar,
                'promo'=> $request->promo ? true : false,
                'prix_actuel'=>$request->prixenciene,
                'prix_promotion'=>$request->prixactuel,
                'categorie_id'=> $request->category_id,
                'sub_category_id'=> $request->sub_category_id ? $request->sub_category_id : null,
            ]);

            if($request->filled(["delete_items"])) {
                $deleteItemsIds = explode(",", $request->delete_items);
                foreach($deleteItemsIds as $deleteItemId) {
                    if($deleteItemId) {
                        $item = ProductSize::find($deleteItemId);
                        if(!is_null($item)) {
                            $item->delete();
                        }
                    }
                }
            } else if($request->filled(["add_items"])) {
                $addItemsIds = explode(',', $request->add_items);
                foreach($addItemsIds as $addItemsId) {
                    if($addItemsId) {
                        if($request->filled(["size_id_$addItemsId"])) {
                            ProductSize::where("id", $request->input("size_id_$addItemsId"))
                            ->update([
                                'size' => $request->input("size-$addItemsId"),
                                'color' => $request->input("color-$addItemsId"),
                                'stock' => $request->input("stock-$addItemsId")
                            ]);
                        } else if($request->filled(["size-$addItemsId", "color-$addItemsId", "stock-$addItemsId"])) {
                            $productSize = new ProductSize();
                            $productSize->product_id = $article->id;
                            $productSize->size = $request->input("size-$addItemsId");
                            $productSize->color = $request->input("color-$addItemsId");
                            $productSize->stock = $request->input("stock-$addItemsId");
                            $productSize->save();
                        }
                    }
                }
            }
            session()->flash('success', "Produit modifié avec succès");
            return redirect('/allProduct');
        }
        return view("edit",["article"=>$article, "sizes" => $sizes]);
    }
}

