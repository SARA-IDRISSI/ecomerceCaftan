<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\ImageProduct;
use App\Models\Product;
use App\Models\ProductSize;
use Illuminate\Http\Request;

class EditController extends Controller
{
    public function edit(Request $request, $id)
    {
        $article = Product::find($id);
        // array column va retourner tout la column de size que  / identifiée par la column_key.=size
        $productSizes = array_column($article->productSizes->toArray(), "size");
        if ($request->isMethod("get")) {
            // arry diff contient diffrent tableaux
            $remainingSizes = array_diff(["XS", "S", "M", "L", "XL", "XXL"], $productSizes);
            return view("admin.edit", ["article" => $article, "sizes" => $remainingSizes]);
        } else if ($request->isMethod('post')) {
            if ($request->filled(['title', 'description', 'codebar', 'prixactuel', 'category_id'])) {
                if ($request->codebar != $article->barcode) {
                    // getQuery():Renvoie la requête de recherche principale
                    $mycodeBar = Product::where("barcode", "=", $request->codebar)->getQuery();
                    if ($mycodeBar->exists()) {
                        session()->flash('error', "Code bar existe déjà");
                        return back();
                    }
                }
                $image = $article->photo;
                //donc image lighadi n ajouter ghadi tmchi liya l had chemin
                if ($request->hasFile('image') && $request->file('image')->isValid()) {
                    $image = 'storage/' . $request->image->store('products/image');
                }
                $instock = 0;
                // *
                // if ($request->size_count > 0) {
                //     for ($i = 1; $i <= $request->size_count; $i++) {
                //         $instock += $request->input("stock-$i");
                //     }
                // }
                $category = Categorie::find($request->category_id);
                Product::where("id", $article->id)->update([
                    'title' => $request->title,
                    'description' => $request->description,
                    'photo' => $image,
                    'barcode' => $request->codebar,
                    'instock' => $instock,
                    'promo' => $request->promo ? true : false,
                    'prix_actuel' => $request->prixactuel,
                    'prix_promotion' => $request->promo ? $request->prixpromotion : null,
                    'categorie_id' => $request->category_id,
                    'qtyB' =>  $category->libeleCateg == "Bijoux" ? $request->qtyB : 0,
                    'sub_category_id' => $category->libeleCateg == "Bijoux" ? $request->sub_category_id : null,
                ]);
                if ($category->libeleCateg !== "Bijoux") {
                    $sizes = array("xs", "s", "m", "l", "xl", "xxl");
                    foreach ($sizes as $size) {
                        // ["colors_indexes_$size"]
                        if ($request->filled(["colors_indexes_$size"])) {
                            // split string
                            $colorsAndStockIndexes = str_split($request->input("colors_indexes_$size"));
                            $colorsAndStocks = [];
                            $totalStock = 0;
                            //* demo pour bien comprie
                            foreach ($colorsAndStockIndexes as $index) {
                                $colorValue = $request->input("color_$index" . "_" . "$size");
                                $stockValue = $request->input("stock_$index" . "_" . "$size");
                                $totalStock += $stockValue;
                                array_push($colorsAndStocks, "$colorValue:$stockValue");
                            }
                            $colorsAndStocksString = implode(",", $colorsAndStocks);
                            if (in_array(strtoupper($size), $productSizes)) {
                                ProductSize::where("product_id", $article->id)
                                    ->where("size", $size)->update([
                                        "colors" => $colorsAndStocksString,
                                        "stock" => $totalStock
                                    ]);
                            } else {
                                $productSize = new ProductSize();
                                $productSize->product_id = $article->id;
                                $productSize->size = strtoupper($size);
                                $productSize->colors = $colorsAndStocksString;
                                $productSize->stock = $totalStock;
                                $productSize->save();
                            }
                        }
                    }
                    // le nom de input formulaire
                    if ($request->filled(["colors_indexes_images"])) {
                        $indexes = str_split($request->colors_indexes_images);
                        foreach ($indexes as $index) {
                            if ($request->missing(["image_id_$index"]) && $request->hasFile("image_$index")) {
                                $imageProduct = new ImageProduct();
                                $imageProduct->image = 'storage/' . $request->file("image_$index")->store("products_images");
                                $imageProduct->color = $request->input("image_color_$index");
                                $imageProduct->product_id = $article->id;
                                $imageProduct->save();
                            } else if ($request->has("image_id_$index")) {
                                $imageProduct = ImageProduct::find($request->input("image_id_$index"));
                                $picture = $imageProduct->image;
                                if ($request->hasFile("image_$index")) {
                                    $picture = 'storage/' . $request->file("image_$index")->store("products_images");
                                }
                                ImageProduct::where("id", $request->input("image_id_$index"))
                                    ->update([
                                        "image" => $picture,
                                        "color" => $request->input("image_color_$index")
                                    ]);
                            }
                        }
                    }
                }
                session()->flash('success', "Produit ajouté avec succès");
                return redirect("/allProduct");
            } else {
                session()->flash('error', "Les champs sont obligatoires");
                return back();
            }
        }
    }
}
