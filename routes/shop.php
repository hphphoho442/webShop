<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\ShopController;
use App\Http\Controllers\Client\OrderController;
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
    Route::POST('/{item}/update', 'update')
    ->name('update');
    Route::DELETE('/destroy/{item}', 'destroy')
    ->name('destroy');
});

Route::middleware(['auth'])->
controller(CheckoutController::class)->
prefix('checkout')->
name('checkout.')->
group(function(){
    route::GET('/', 'index')->name('index');
    route::POST('/order/store', 'index')->name('name');
});

Route::middleware(['auth'])->
controller(AddressController::class)->
prefix('address')->
name('address.')->
group(function(){
    Route::GET('/', 'create')->name('create');
    Route::POST('/store', 'store')->name('store');
});

Route::middleware(['auth'])->
controller(OrderController::class)->
prefix('order')->
name('order.')->
group(function(){
    Route::GET('/', 'index')->name('index');
    Route::GET('/show/{order}', 'show')->name('show');
    Route::POST('/store', 'store')->name('store');
    Route::POST('/cancel/{order}', 'cancel')->name('cancel');
});