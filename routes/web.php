<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AllProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\changePasswordController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EditController;
use App\Http\Controllers\PannierController;
use App\Http\Controllers\CordonnerPayerController;
use App\Http\Controllers\forgotPasswordController;
use App\Http\Controllers\PaimentController;
use \App\Http\Controllers\ListCategoryController;
use \App\Http\Controllers\ListSubCatController;
use App\Http\Controllers\listOrderController;
use App\Http\Controllers\NewArivalsController;
use App\Http\Controllers\newCategoryController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\proposControl;
use App\Http\Controllers\WishlistController;
use App\Http\Livewire\AllProductComponent;
use App\Http\Livewire\CategoryComponent;
use App\Http\Livewire\ContacterComponent;
use App\Http\Livewire\EditCategoryComponent;
use App\Http\Livewire\EditSubCategoryComponent;
use App\Http\Livewire\EditSuBCategoryComponents;
use App\Http\Livewire\EditUserComponent;
use App\Http\Livewire\NewArivalsComponent;
use App\Http\Livewire\SearchComponent;
use Illuminate\Support\Facades\Route;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, "index"]);
Route::get('/home', [HomeController::class, "index"]);
Route::get('/propos', [proposControl::class, "propos"]);

Route::get('/login', [AuthController::class, "login"])->name('login');
Route::post('/login', [AuthController::class, "login"])->name('post-login');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'register']);
Route::post('/register', [AuthController::class, 'register']);

Route::get('/detailProduct/{id}', [DetailController::class, 'getProduct']);

Route::get('/EditUser', [AdminController::class, "editUser"]);

Route::get('/admin', [AdminController::class, 'admin']);

Route::get('/allProduct', [AllProductController::class, 'index']);

Route::get('/listOrder', [listOrderController::class, "listOrder"]);

Route::get('/listCategory', [ListCategoryController::class, "allListCategory"]);
Route::post('/listCategory', [ListCategoryController::class, "allListCategory"]);

Route::get('/listSubCategory', [ListSubCatController::class, "allListSubCategory"]);
Route::post('/listSubCategory', [ListSubCatController::class, "allListSubCategory"]);

Route::get('/dashboard', [DashboardController::class, "getDashboard"]);
Route::post('/dashboard', [DashboardController::class, "getDashboard"]);

Route::get('/NewArivals', NewArivalsComponent::class);

Route::get('/category/{id}', CategoryComponent::class);
Route::post('/category/{id}', CategoryComponent::class);



Route::get('/add-product', [AdminController::class, "addProduct"])->name('add-product');
Route::post('/add-product', [AdminController::class, "addProduct"])->name('post-product');

Route::get('/add-category', [AdminController::class, "addCategory"]);
Route::post('/add-category', [AdminController::class, "addCategory"]);

Route::get('/add-subcategory', [AdminController::class, "addSubCategory"]);
Route::post('/add-subcategory', [AdminController::class, "addSubCategory"]);

Route::get('/edit/{id}', [EditController::class, "edit"]);
Route::post('/edit/{id}', [EditController::class, "edit"]);

Route::get('/delete/{id}', [AllProductController::class, "delete"]);
Route::get('/delete-category/{id}', [ListCategoryController::class, "delete"]);
Route::get('/delete-sub-category/{id}', [ListSubCatController::class, "delete"]);

Route::get('/pannier', [PannierController::class, "pannier"]);
Route::post('/pannier', [PannierController::class, "pannier"])->name('pannier');



Route::get('/wishlist', [WishlistController::class, "getWishlist"]);
Route::get('/add-to-wishlist/{id}', [WishlistController::class, "addToWishlist"]);
Route::get('/delete-from-wishlist/{rowId}', [WishlistController::class, "deleteFromWishlist"]);

Route::get('/upgrade/{rowId}', [PannierController::class, "upgrade"])->name('upgrade');
Route::get('/degrade/{rowId}', [PannierController::class, "degrade"])->name('degrade');
Route::get('/delete-from-cart/{rowId}', [PannierController::class, "deleteFromCart"])->name('delete-from-cart');

Route::get('/cordonnerPayer', [CordonnerPayerController::class, "cordonnerPayer"]);
Route::post('/cordonnerPayer', [CordonnerPayerController::class, "cordonnerPayer"]);

Route::get('/paiment', [PaimentController::class, "paiment"]);
Route::post('/paiment', [PaimentController::class, "paiment"]);

Route::post('/pay', [PaimentController::class, "pay"])->name("pay");

Route::post('/buyNow', [DetailController::class, "buyNow"]);

Route::post('/save-user-details', [OrdersController::class, "saveOrderUserDetails"])->name("save-user-details");
Route::get('/make-order', [OrdersController::class, "makeOrder"])->name("make-order");

Route::get('/show/{id}', [listOrderController::class, "show"]);

Route::get('/newCategory',  [newCategoryController::class, "newCategory"]);
Route::post('/newCategory',  [newCategoryController::class, "newCategory"]);

Route::get('/forgotPassword', [forgotPasswordController::class, "forgot"]);
Route::post('/sendEmail', [forgotPasswordController::class, "sendEmail"])->name("sendEmail");

Route::get('/changePassword', [changePasswordController::class, "changePassword"]);
Route::post('/changePassword', [changePasswordController::class, "changePassword"]);

Route::get('/search', SearchComponent::class)->name('product.search');

Route::get('/contact', ContacterComponent::class);
Route::get('/editCat/{id}', EditCategoryComponent::class)->name('editCateg');
Route::get('/editSubCat/{id}', EditSuBCategoryComponents::class)->name('editSubCateg');


// Route::get('/editSubCat/{id}',EditSubCategoryComponent::class)->name('editCateg');
