<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\StockController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('testing', function (){
    return 'this is riyad';
});

Route::get('/',[ProductController::class,'index'])->name('products.index');
Route::get('products/Create',[ProductController::class,'create'])->name('products.create');
Route::post('products/store',[ProductController::class,'store'])->name('products.store');

Route::get('products/{id}/edit',[ProductController::class,'edit']);
Route::put('products/update',[ProductController::class,'updateProduct']);
Route::delete('products/delete',[ProductController::class,'destroyProduct']);

Route::post('stock/store',[ProductController::class,'Stockstore']);

