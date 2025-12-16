<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\ShopController;
use App\Http\Controllers\Client\CheckoutController;


Route::middleware(['auth'])->
controller(ShopController::class)->
name('shop.')->
prefix('shop')->
group(function(){
    Route::GET('/',[ShopController::class, 'index'])->name('index');
    // shop
    Route::get('/{product}', 'show')
    ->name('show');
});

Route::middleware(['auth'])->
controller(CartController::class)->
name('cart.')->
prefix('cart')->
group(function(){
    Route::GET('/', 'index')
    ->name('index');
    Route::POST('/add/{product}', 'add')
    ->name('add');
});

Route::middleware(['auth'])->
controller(CheckoutController::class)->
prefix('checkout')->
name('checkout.')->
group(function(){
    route::GET('/', 'index')->name('index');
});