<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// View
Route::get('/', [ProductController::class, 'index']);

// Dashboard Statistics
Route::get('/statistics', [ProductController::class, 'statistics']);

// Product List (Search + Pagination)
Route::get('/products', [ProductController::class, 'getProducts']);

// Single Product
Route::get('/products/{id}', [ProductController::class, 'show']);

// Create Product
Route::post('/products', [ProductController::class, 'store']);

// Update Product
Route::put('/products/{id}', [ProductController::class, 'update']);

// Delete Product
Route::delete('/products/{id}', [ProductController::class, 'destroy']);