<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\StockController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/index',[ProductController::class,'index'])->name('products.index');
Route::get('products/Create',[ProductController::class,'create'])->name('products.create');
Route::post('products/store',[ProductController::class,'store'])->name('products.store');

Route::get('products/{id}/edit',[ProductController::class,'edit']);
Route::put('products/{id}/update',[ProductController::class,'update']);
Route::get('products/{id}/delete',[ProductController::class,'destroy']);


// category

Route::get('categories/index',[CategoryController::class,'index'])->name('categories.index');
Route::get('categories/Create',[CategoryController::class,'create'])->name('categories.create');
Route::post('categories/store',[CategoryController::class,'store'])->name('categories.store');
Route::get('categories/{id}/edit',[CategoryController::class,'edit']);
Route::get('categories/{id}/delete',[CategoryController::class,'destroy']);
Route::put('categories/{id}/update',[CategoryController::class,'update']);


//brand
Route::get('brands/index',[BrandController::class,'index'])->name('brands.index');
Route::get('brands/Create',[BrandController::class,'create'])->name('brands.create');
Route::post('store',[BrandController::class,'store'])->name('brands.store');
Route::get('brands/{id}/edit',[BrandController::class,'edit']);
Route::get('brands/{id}/delete',[BrandController::class,'destroy']);
Route::put('{id}/update',[BrandController::class,'update']);


//stock
  Route::get('stocks/index',[StockController::class,'index'])->name('stock.index');
// Route::get('stocks/Create',[StockController::class,'create'])->name('stocks.create');
// Route::post('products/store',[StockController::class,'store'])->name('stocks.store');
  Route::get('stocks/{id}/delete',[StockController::class,'destroy']);


