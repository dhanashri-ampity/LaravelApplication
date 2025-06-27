<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductImageController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Mail;

Route::get('/', function () {
    return view('welcome');
});

Route::get('products/trashed', [ProductController::class, 'trashed'])->name('products.trashed');

Route::post('/products/image-upload', [ProductImageController::class, 'upload'])->name('products.upload');

Route::resource('products', ProductController::class);


Route::post('products/{id}/restore', [ProductController::class, 'restore'])->name('products.restore');

Route::get('/test-mail', function () {
    Mail::raw('This is a test email!', function ($message) {
        $message->to('dhanashrijoshi18@gmail.com') // <-- put your email here
                ->subject('Test Email');
    });
    return 'Mail sent!';
});
