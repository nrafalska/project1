<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ParserController;
use App\Http\Controllers\CaptchaController;
use App\Http\Controllers\ProxyController;
use App\Http\Controllers\PriceController;

Route::get('/', function () {
    return view('welcome');
});

// Standard resource routes for products and shops
Route::resource('products', ProductController::class);
Route::resource('shops', ShopController::class);

// Additional custom routes for viewing prices for a specific product in different shops
Route::get('products/{product}/prices', [ProductController::class, 'showPrices'])->name('products.prices');

// Additional custom routes for viewing prices for a specific shop across different products
Route::get('shops/{shop}/prices', [ShopController::class, 'showPrices'])->name('shops.prices');

// Resource route for prices, if you need to perform CRUD operations on prices directly
Route::resource('prices', PriceController::class);



// Resource routes for users and categories
Route::resource('users', UserController::class);
Route::resource('categories', CategoryController::class);
// Assuming you want to create routes to display the shop's products, parsers, etc.
Route::get('shops/{shop}/products', [ShopController::class, 'showProducts']);
Route::get('shops/{shop}/parsers', [ShopController::class, 'showParsers']);
// ... and so on for other relationships
// Additional nested resource routes or custom routes for categories within products can be added as needed