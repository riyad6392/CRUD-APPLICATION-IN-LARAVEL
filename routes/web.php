<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;



Route::get('/',[ProductController::class,'index'])->name('products.index');
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




