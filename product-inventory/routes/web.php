<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductImageController;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('products/trashed', [ProductController::class, 'trashed'])->name('products.trashed');

Route::post('/products/image-upload', [ProductImageController::class, 'upload'])->name('products.upload');

Route::resource('products', ProductController::class);


Route::post('products/{id}/restore', [ProductController::class, 'restore'])->name('products.restore');
