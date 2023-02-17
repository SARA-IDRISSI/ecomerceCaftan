<?php

namespace App\Http\Controllers;

use App\Mail\NewProductMail;
use App\Models\Product;
use App\Models\ProductSize;
use Illuminate\Http\Request;
use App\Models\Categorie;
use App\Models\ImageProduct;
use App\Models\SubCategory;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    public function admin()
    {
        return view("admin.dashboard");
    }

    public function addProduct(Request $request)
    {
        if ($request->isMethod('post')) {
            if ($request->filled(['title', 'description', 'codebar', 'prixenciene', 'prixactuel', 'category_id'])) {
                if ($request->hasFile('image') && $request->file('image')->isValid()) {
                    $image = 'storage/' . $request->image->store('products/image');
                    $instock = 0;
                    if ($request->size_count > 0) {
                        for ($i = 1; $i <= $request->size_count; $i++) {
                            $instock += $request->input("stock-$i");
                        }
                    }
                    $product = Product::create([
                        'title' => $request->title,
                        'description' => $request->description,
                        'photo' => $image,
                        'barcode' => $request->codebar,
                        'instock' => $instock,
                        'promo' => $request->promo ? true : false,
                        'prix_actuel' => $request->prixactuel,
                        'prix_promotion' => $request->prixpromotion,
                        'categorie_id' => $request->category_id,
                        'sub_category_id' => $request->sub_category_id ? $request->sub_category_id : null,
                    ]);
                    $sizes = array("xs", "s", "m", "l", "xl", "xxl");
                    foreach ($sizes as $size) {
                        if ($request->filled(["colors_indexes_$size"])) {
                            $colorsAndStockIndexes = str_split($request->input("colors_indexes_$size"));
                            $colorsAndStocks = [];
                            $totalStock = 0;
                            foreach ($colorsAndStockIndexes as $index) {
                                $colorValue = $request->input("color_$index" . "_" . "$size");
                                $stockValue = $request->input("stock_$index" . "_" . "$size");
                                $totalStock += $stockValue;
                                array_push($colorsAndStocks, "$colorValue:$stockValue");
                            }
                            $colorsAndStocksString = implode(",", $colorsAndStocks);
                            $productSize = new ProductSize();
                            $productSize->product_id = $product->id;
                            $productSize->size = strtoupper($size);
                            $productSize->colors = $colorsAndStocksString;
                            $productSize->stock = $totalStock;
                            $productSize->save();
                        }
                    }
                    if ($request->filled(["colors_indexes_images"])) {
                        $indexes = str_split($request->colors_indexes_images);
                        foreach ($indexes as $index) {
                            if ($request->hasFile("image_$index")) {
                                $imageProduct = new ImageProduct();
                                $imageProduct->image = 'storage/' . $request->file("image_$index")->store("products_images");
                                $imageProduct->color = $request->input("image_color_$index");
                                $imageProduct->product_id = $product->id;
                                $imageProduct->save();
                            }
                        }
                    }
                    $newProduct = Product::find($product->id);
                    foreach (User::where("newsletter", 1)->lazy() as $user) {
                        Mail::to($user->email)->send(new NewProductMail($newProduct));
                    }
                    session()->flash('success', "Produit ajouté avec succès");
                    return redirect("/allProduct");
                } else {
                    session()->flash('error', "L'image est obligatoire");
                    return back();
                }
            } else {
                session()->flash('error', "Les champs sont obligatoires");
                return back();
            }
        }
        return view("admin.addProduct");
    }
    public function addCategory(Request $request)
    {
        if ($request->isMethod('post')) {
            if ($request->filled(['title'])) {
                Categorie::create([
                    'libeleCateg' => $request->title
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
    public function addSubCategory(Request $request)
    {
        if ($request->isMethod('post')) {
            if ($request->filled(['title', 'category_id'])) {
                SubCategory::create([
                    'title' => $request->title,
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

    public function editUser()
    {
        return view("auth.editUser");
    }
}
