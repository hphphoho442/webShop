<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\ShopController;


Route::
name('shop.')->
prefix('shop')->
group(function(){
    Route::GET('/',[ShopController::class, 'index'])->name('index');
});

