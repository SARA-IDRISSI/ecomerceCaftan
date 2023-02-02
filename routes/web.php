<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AllProductController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EditController;
use App\Http\Controllers\PannierController;
use App\Http\Controllers\CordonnerPayerController;



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

Route::get('/login', [AuthController::class, "login"])->name('login');
Route::post('/login', [AuthController::class, "login"])->name('post-login');


Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/register', [AuthController::class, 'register']);
Route::post('/register', [AuthController::class, 'register']);

Route::get('/detailProduct/{id}', [DetailController::class, 'getProduct']);

Route::get('/category/{id}', [CategoryController::class, 'getCategoryProducts']);

Route::get('/admin',[AdminController::class,'admin']);


Route::get('/allProduct',[AllProductController::class, "allProduct"]);
Route::post('/allProduct',[AllProductController::class, "allProduct"]);

Route::get('/dashboard',[DashboardController::class, "getDashboard"]);
Route::post('/dashboard',[DashboardController::class, "getDashboard"]);

Route::get('/add-product',[AdminController::class, "addProduct"])->name('add-product');
Route::post('/add-product',[AdminController::class, "addProduct"])->name('post-product');

Route::get('/add-category',[AdminController::class, "addCategory"]);
Route::post('/add-category',[AdminController::class, "addCategory"]);

Route::get('/add-subcategory',[AdminController::class, "addSubCategory"]);
Route::post('/add-subcategory',[AdminController::class, "addSubCategory"]);

Route::get('/edit/{id}',[EditController::class, "edit"]);
Route::post('/edit/{id}',[EditController::class, "edit"]);

Route::get('/delete/{id}',[AllProductController::class, "delete"]);

Route::get('/pannier',[PannierController::class, "pannier"]);
Route::post('/pannier',[PannierController::class, "pannier"]);

Route::get('/cordonnerPayer',[CordonnerPayerController::class, "cordonnerPayer"]);
Route::post('/cordonnerPayer',[CordonnerPayerController::class, "cordonnerPayer"]);
