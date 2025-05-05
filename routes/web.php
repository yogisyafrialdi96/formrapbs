<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/data', [ProductController::class, 'datarapbs'])->name('product.index');
Route::get('form-rapbs', [ProductController::class, 'add']);
Route::post('add-more', [ProductController::class, 'store'])->name('add-more.store');;
